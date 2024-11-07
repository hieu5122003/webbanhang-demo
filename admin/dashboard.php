<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $currentTime = date('d-m-Y h:i:s A', time());

    function countTotalOrders()
    {
        global $con;
        $query = mysqli_query($con, "SELECT COUNT(*) as total FROM orders");
        $result = mysqli_fetch_assoc($query);
        return $result['total'];
    }

    function countOrdersThisMonth()
    {
        global $con;
        $month = date('m');
        $query = mysqli_query($con, "SELECT COUNT(*) as total FROM orders WHERE MONTH(orderDate) = $month");
        $result = mysqli_fetch_assoc($query);
        return $result['total'];
    }

    function countOrdersToday()
    {
        global $con;
        $today = date('Y-m-d');
        $query = mysqli_query($con, "SELECT COUNT(*) as total FROM orders WHERE DATE(orderDate) = '$today'");
        $result = mysqli_fetch_assoc($query);
        return $result['total'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quản trị viên | Dashboard</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>

</head>

<body>
    <?php include('include/header.php'); ?>

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php include('include/sidebar.php'); ?>
                <div class="span9">
                    <div class="content">
                        <div class="module">
                            <div class="module-head">
                                <h3>Dashboard</h3>
                            </div>
                            <div class="module-body">
                                <div class="row">
                                    <div class="span3">
                                        <div class="widget">
                                            <div class="widget-body">
                                                <div class="center">
                                                    <h3>Tổng số đơn đặt hàng</h3>
                                                    <p><?php echo countTotalOrders(); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span3">
                                        <div class="widget">
                                            <div class="widget-body">
                                                <div class="center">
                                                    <h3>Số đơn hàng trong tháng</h3>
                                                    <p><?php echo countOrdersThisMonth(); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span3">
                                        <div class="widget">
                                            <div class="widget-body">
                                                <div class="center">
                                                    <h3>Số đơn hàng trong ngày</h3>
                                                    <p><?php echo countOrdersToday(); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('include/footer.php'); ?>

    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
</body>

</html>

<?php
}
?>
