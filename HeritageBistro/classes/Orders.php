<?php
class Orders
{
    // ADDING NEW MENU
    function addOrder($data, $orderDetails)
    {
        global $con;

        $total_amount = 0;
        foreach ($orderDetails as $orderDetail) {
            $subtotal = $orderDetail['price'] * $orderDetail['quantity'];
            $total_amount += $subtotal;
        }

        $sql = "INSERT INTO tbl_orders (total_amount, order_date) VALUES (:total_amount, NOW())";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':total_amount', $total_amount);

        if ($stmt->execute()) {
            $lastOrderId = $con->lastInsertId();

            foreach ($orderDetails as $orderDetail) {
                $menu_id = $orderDetail['menu_id'];
                $menu_name = $orderDetail['menu_name'];
                $price = $orderDetail['price'];
                $quantity = $orderDetail['quantity'];
                $subtotal = $price * $quantity;

                $sql = "INSERT INTO tbl_order_details (order_id, menu_id, menu_name, price, quantity, subtotal) 
                    VALUES (:order_id, :menu_id, :menu_name, :price, :quantity, :subtotal)";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':order_id', $lastOrderId);
                $stmt->bindParam(':menu_id', $menu_id);
                $stmt->bindParam(':menu_name', $menu_name);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':quantity', $quantity);
                $stmt->bindParam(':subtotal', $subtotal);
                $stmt->execute();
            }

            return $lastOrderId;
        } else {
            return false;
        }
    }
    // DISPLAYING ALL ORDERS
    function displayOrders()
    {
        global $con;

        $sql = "SELECT o.id AS order_id, o.total_amount, o.order_date,
            d.menu_name, d.price, d.quantity, d.subtotal
            FROM tbl_orders AS o
            JOIN tbl_order_details AS d ON o.id = d.order_id";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $formattedOrders = [];

        foreach ($orders as $order) {
            $orderId = $order['order_id'];

            if (!isset($formattedOrders[$orderId])) {
                $formattedOrders[$orderId] = [
                    'order_id' => $orderId,
                    'total_amount' => $order['total_amount'],
                    'order_date' => $order['order_date'],
                    'order_details' => []
                ];
            }

            $formattedOrders[$orderId]['order_details'][] = [
                'menu_name' => $order['menu_name'],
                'price' => $order['price'],
                'quantity' => $order['quantity'],
                'subtotal' => $order['subtotal']
            ];
        }

        return array_values($formattedOrders);
    }
    // DISPLAY SPECIFIC ORDEr
    function getOrderById($order_id)
    {
        global $con;

        $sql = "SELECT o.id AS order_id, o.total_amount, o.order_date, o.status,
            d.menu_name, d.price, d.quantity, d.subtotal
            FROM tbl_orders AS o
            JOIN tbl_order_details AS d ON o.id = d.order_id
            WHERE o.id = :order_id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();

        $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($orderDetails)) {
            return null; // Order not found
        }

        $formattedOrder = [
            'order_id' => $orderDetails[0]['order_id'],
            'total_amount' => $orderDetails[0]['total_amount'],
            'order_date' => $orderDetails[0]['order_date'],
            'status' => $orderDetails[0]['status'], // Include the status field
            'order_details' => []
        ];

        foreach ($orderDetails as $order) {
            $formattedOrder['order_details'][] = [
                'menu_name' => $order['menu_name'],
                'price' => $order['price'],
                'quantity' => $order['quantity'],
                'subtotal' => $order['subtotal']
            ];
        }

        return $formattedOrder;
    }

    // CHANGE TO RECEIVED ORDER
    function updateOrderStatus($order_id)
    {
        global $con;

        $sql = "UPDATE tbl_orders SET status = 1 WHERE id = :order_id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':order_id', $order_id);

        return $stmt->execute();
    }
}
?>