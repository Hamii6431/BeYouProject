
<div class="dashboard-cards">
    <div class="card">
        <div class="card-text">
            <h2><?php echo $allUsers; ?></h2>
            <h4>User registed</h4>
        </div>
        <div class="card-icon">
            <span class="material-symbols-outlined">group</span>
        </div>
    </div>

    <div class="card">
        <div class="card-text">
            <h2><?php echo $allProducts; ?></h2>
            <h4>Product added</h4>
        </div>
        <div class="card-icon">
            <span class="material-symbols-outlined">category</span>
        </div>
    </div>

    <div class="card">
        <div class="card-text">
            <h2><?php echo $allFinalOrders; ?></h2>
            <h4>Orders placed</h4>
        </div>
        <div class="card-icon">
            <span class="material-symbols-outlined">order_approve</span>
        </div>
    </div>

    <div class="card">
        <div class="card-text">
            <h2><?php echo $allIncome . ' $'; ?></h2>
            <h4>Total income</h4>
        </div>
        <div class="card-icon">
            <span class="material-symbols-outlined">payments</span>
        </div>
    </div>
</div>
<div class="dashboard-base">
    <div class="recent-payments">
        <div class="recent-payments-header">
            <h2>Recent Payments</h2>
        </div>
        <div class="recent-payments-table">
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
                    <?php foreach ($latestOrders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['final_order_id']) ?></td>
                        <td><?= htmlspecialchars($order['user_id']) ?></td>
                        <td><?= htmlspecialchars($order['total_price']) ?></td>
                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                        <td><?= htmlspecialchars($order['status']) ?></td>
                        <td><?= htmlspecialchars($order['shipping_address_id']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (count($latestOrders) === 0): ?>
                    <tr>
                        <td colspan="5">No orders found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<div class="new-users">
    <div class="new-users-header">
        <h2>New Users</h2>
    </div>
    <div class="new-users-table">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($latestUsers as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['user_ID']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['first_name']) ?></td>
                    <td><?= htmlspecialchars($user['last_name']) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (count($latestUsers) === 0): ?>
                <tr>
                    <td colspan="5">No users found</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
