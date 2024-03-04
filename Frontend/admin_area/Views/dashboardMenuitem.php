<style>
    .surface{
        padding: 1rem;
    }
    .dashboard-cards{
        display: flex;
        justify-content: space-between;
        gap:2rem;
    }
    .card{
        display: flex;
        border-radius: 6px;
        gap:0.75rem;
        width: 25%;
        padding:1.5rem;
        background-color: rgba(131, 165, 202, 0.5);
        box-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .card-text{
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .card-text h2,.card-text h4{
        margin:0;
    }
    .card-icon{
        display: flex;
        justify-content: end;
        align-items: center;
    }
    .card-icon span{
        font-size: 60px;
    }





    .dashboard-base{
        display: flex;
        justify-content: space-between;
        gap:2rem;
    }
    .recent-payments, .new-users{
        border-radius: 6px;
        margin-top: 3rem;
        width:63%;
        background-color: rgba(131, 165, 202, 0.5);
        box-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .recent-payments-header, .new-users-header{
        display: flex;
        justify-content: center;
        border-bottom: 2px solid black;
    }

    table {
            width: 100%;
            border-collapse: collapse;
            
        }
        table, th, td {
            border: 1px solid black;
            
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
</style>



<div class="surface">
    <div class="dashboard-cards">
        <div class="card">
            <div class="card-text">
                <h2>9</h2>
                <h4>User registed</h4>
            </div>
            <div class="card-icon">
                <span class="material-symbols-outlined">group</span>
            </div>
        </div>

        <div class="card">
            <div class="card-text">
                <h2>32</h2>
                <h4>Product added</h4>
            </div>
            <div class="card-icon">
                <span class="material-symbols-outlined">category</span>
            </div>
        </div>

        <div class="card">
            <div class="card-text">
                <h2>6</h2>
                <h4>Orders placed</h4>
            </div>
            <div class="card-icon">
                <span class="material-symbols-outlined">order_approve</span>
            </div>
        </div>

        <div class="card">
            <div class="card-text">
                <h2>136$</h2>
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
                        <!-- Példa sorok (Ezeket töltsd ki az adatbázisból származó adatokkal) -->
                        <tr>
                            <td>1</td>
                            <td>101</td>
                            <td>$150.00</td>
                            <td>2024-03-03</td>
                            <td>Feldolgozás alatt</td>
                            <td>205</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>101</td>
                            <td>$150.00</td>
                            <td>2024-03-03</td>
                            <td>Feldolgozás alatt</td>
                            <td>205</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>101</td>
                            <td>$150.00</td>
                            <td>2024-03-03</td>
                            <td>Feldolgozás alatt</td>
                            <td>205</td>
                        </tr>
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
                        <tr>
                            <td>101</td>
                            <td>john_doe</td>
                            <td>johndoe@example.com</td>
                            <td>John</td>
                            <td>Doe</td>
                        </tr>
                        <tr>
                            <td>101</td>
                            <td>john_doe</td>
                            <td>johndoe@example.com</td>
                            <td>John</td>
                            <td>Doe</td>
                        </tr>
                        <tr>
                            <td>101</td>
                            <td>john_doe</td>
                            <td>johndoe@example.com</td>
                            <td>John</td>
                            <td>Doe</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>