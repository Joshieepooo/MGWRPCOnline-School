<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!----------------
              PHP
        ---------------->
     <?php
            include 'PHP/checker.php';
            ?>
    
        <!---------------
               TAB
        ---------------->
        <title>MGWR PC | Analytics</title>
        <link rel="icon" href="Images/Tab Icon.png" type="image/x-icon">
    
        <!---------------
             CSS & JS
        ---------------->
        <link rel="stylesheet" href="css/mainstyle.css">
        <link rel="stylesheet" href="css/admin-analytics.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
        <!---------------
              FONTS
        ---------------->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
        <!---------------
              ICONS
        ---------------->
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    </head>
    
    
    
    <body>
        <!---------------
              NAVBAR
        ---------------->
        <header class="header">
            <a href="admin-analytics.php"><img src="Images/MGWR PC Logo.png" alt="" class="logo"></a>
    
            <input type="checkbox" id="check">
            <label for="check" class="icons">
                <img src="Images/Menu.png" alt="" id="menu-icon">
                <img src="Images/MenuX.png" alt="" id="close-icon">
            </label>
    
            <nav class="navbar">
                <a class="active" href="admin-analytics.php" style="--i:0">Analytics</a>
               <a href="admin-inventory.php" style="--i:1">Inventory</a>
                <a href="admin-reservation.php" style="--i:1">Reservation</a>
                <a href="admin-cms.php" style="--i:2">CMS</a>
                <a href="admin-feedback.php" style="--i:3">Feedbacks</a>
                <a href="admin-contact-us.php" style="--i:4">Inbox</a>
                <form  method="post"     >
                     <button type="submit" style="--i:5" name="LG">Logout</button>
                 </form>
            </nav>
        </header>
    
    
    
        <!---------------
             CHARTS
        ---------------->
        <div class="chartSection1">
            <div class="chartLabel"><h1>PC Reserves</h1></div>
            <div class="chartBox">
                <canvas id="myChart"></canvas>
            </div>
        </div>
      
        <script>
            fetch('PHP/admin-charts.php')
            .then(response => response.json())
            .then(data => {
                console.log(data); // Add this line to log the data
                const labels = data.map(item => item.products_name);
                const values = data.map(item => item.reserved_units);
        
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Reserved Units',
                            data: values,
                            backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                             ] ,
                            borderColor: [
                            'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                            ],
                                    borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
        </script>


    
        <!---------------
           2nd CHART
        ---------------->
        <div class="chartSection2">
            <div class="chartLabel"><h1>Laptop Reserves</h1></div>
            <div class="chartBox2">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        
        <script>
            fetch('PHP/admin-charts2.php')
            .then(response => response.json())
            .then(data => {
                console.log(data); 
                const labels = data.map(item => item.products_name);
                const values = data.map(item => item.reserved_units);
        
                const ctx = document.getElementById('myChart2').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Reserved Units',
                            data: values,
                            backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                             ] ,
                            borderColor: [
                            'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                            ],
                                    borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
        </script>
        
        
        
        <!---------------
            3rd CHART
        ---------------->
        <div class="chartSection3">
            <div class="chartLabel"><h1>Printer Reserves</h1></div>
            <div class="chartBox3">
                <canvas id="myChart3"></canvas>
            </div>
        </div>
                
        <script>
            fetch('PHP/admin-charts3.php')
            .then(response => response.json())
            .then(data => {
                console.log(data); 
                const labels = data.map(item => item.products_name);
                const values = data.map(item => item.reserved_units);
        
                const ctx = document.getElementById('myChart3').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Reserved Units',
                            data: values,
                            backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                             ] ,
                            borderColor: [
                            'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                            ],
                                    borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
        </script>
    </body>
</html>