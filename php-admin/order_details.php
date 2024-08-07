<?php
include ("connection/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['orderyid'])) {
        $orderyId = $_POST['orderyid'];
        $stmt_order_details = $conn->prepare("SELECT * FROM order_details WHERE order_id = :orderyid");
        $stmt_order_details->bindParam(':orderyid', $orderyId, PDO::PARAM_INT);
        $stmt_order_details->execute();
        $order_details = $stmt_order_details->fetchAll(PDO::FETCH_ASSOC);
    } elseif (isset($_POST['orderDId'])) {
        $orderDId = $_POST['orderDId'];
        $stmt_delete_order_details = $conn->prepare("DELETE FROM order_details WHERE order_details_id = :orderDId");
        $stmt_delete_order_details->bindParam(':orderDId', $orderDId, PDO::PARAM_INT);
        $stmt_delete_order_details->execute();

        if (isset($_POST['orderyid'])) {
            $orderyId = $_POST['orderyid'];
            $stmt_order_details = $conn->prepare("SELECT * FROM order_details WHERE order_id = :orderyid");
            $stmt_order_details->bindParam(':orderyid', $orderyId, PDO::PARAM_INT);
            $stmt_order_details->execute();
            $order_details = $stmt_order_details->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $order_details = [];
        }
    } else {
        $order_details = [];
    }
} else {
    $order_details = [];
}
?>

<div class="table-responsive">
    <div class="table-wrapper" style="max-height: 400px; overflow: auto;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order Details ID</th>
                    <th>Order Details Quantity</th>
                    <th>Product Quantity price</th>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th class="text-right">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_details as $the_details): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($the_details['order_details_id']); ?></td>
                        <td><?php echo htmlspecialchars($the_details['order_details_qty']); ?></td>
                        <td><?php echo htmlspecialchars($the_details['pro_qty_price']); ?></td>
                        <td><?php echo htmlspecialchars($the_details['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($the_details['product_id']); ?></td>
                        <td class="text-right">
                            <form class="delete-form" data-order-id="<?php echo htmlspecialchars($the_details['order_id']); ?>" action="order_details.php" method="post">
                                <input type="hidden" name="orderDId" value="<?php echo htmlspecialchars($the_details['order_details_id']); ?>">
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="mdi mdi-delete-forever"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>