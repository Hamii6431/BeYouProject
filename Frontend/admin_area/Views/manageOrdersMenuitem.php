
<body>
    
    <div class="surface">
        <div class="dashboard-base1">
            <div class="recent-orders">
                <div class="recent-orders-header">
                    <h2>Manage Orders</h2>
                </div>
                <div class="recent-orders-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer ID</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Shipping Address ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderCount as $order): ?>
                            <tr>
                                <td><?= htmlspecialchars($order['final_order_id']) ?></td>
                                <td><?= htmlspecialchars($order['user_id']) ?></td>
                                <td><?= htmlspecialchars($order['total_price']) ?></td>
                                <td><?= htmlspecialchars($order['order_date']) ?></td>
                                <td><?= htmlspecialchars($order['status']) ?></td>
                                <td><?= htmlspecialchars($order['shipping_address_id']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (count($orderCount) === 0): ?>
                            <tr>
                                <td colspan="5">No orders found</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




</body>