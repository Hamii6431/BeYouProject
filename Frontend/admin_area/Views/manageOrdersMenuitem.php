
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
                                <th>Edit</th>
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
                                <td><button class="modalButton" onclick="openModal(<?= htmlspecialchars($order['final_order_id']) ?>)">Edit</button></td>
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


    <!-- Modális Ablak HTML -->
    <div id="editOrderStatusModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Order Status</h2>
        <form id="editStatusForm">
            <input type="hidden" name="editFinal_order_id" id="editFinal_order_id" value="">
                
                <div class="form-group">
                    <label for="editStatus">Select order Status: </label>
                    <select name="editStatus" id="editStatus" required>
                        <option value="">--Select Order Status--</option>
                        <?php foreach ($orderCount as $order): ?>
                            <option value="<?= $order['final_order_id'] ?>"><?= $order['status'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>  

                <button class="modalButton2" type="button" onclick="updateOrderStatus()">Save</button>
            
            </form>
        </div>
    </div>



<script>
    function openModal(finalOrderId) {
        fetch(`/BeYou_web/Beyouproject/Backend/controllers/AdminContentController.php?action=getOrderDetails&final_order_id=${finalOrderId}`)
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error('Error fetching order data:', data.message);
                return;
            }

            document.getElementById('editFinal_order_id').value = finalOrderId;
            document.getElementById('editStatus').value = data.data.status || '';

            document.getElementById('editOrderStatusModal').style.display = 'block';
        })
        .catch(error => console.error('Error:', error));
    }

    // Modális ablak bezárása
    var modal = document.getElementById('editOrderStatusModal');
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    
    function updateOrderStatus() {
    var formData = new FormData(document.getElementById('editStatusForm'));
    formData.append('action', 'updateOrderStatus');

    fetch('/BeYou_web/Beyouproject/Backend/controllers/AdminContentController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if(data.success) {
            document.getElementById('editOrderStatusModal').style.display = 'none';
            // Itt frissítheted a felhasználók listáját az UI-on, ha szükséges
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>


</body>