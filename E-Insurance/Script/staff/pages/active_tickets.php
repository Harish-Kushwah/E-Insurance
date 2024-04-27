<?php

?>
﻿<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?php echo WBName; ?> - Active Tickets</title>
<meta name="description" content="Insurance Management System">
<!-- <meta name="author" content="Bwire Mashauri"> -->
<base href="../">
<link rel="shortcut icon" href="assets/media/favicons/favicon.ico">
<link rel="stylesheet" id="css-main" href="assets/css/dashmix.min-5.4.css">
<link rel="stylesheet" href="assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
<link type="text/css" rel="stylesheet" href="assets/loader/waitMe.css">
<?php if (Theme !== "") { print '<link rel="stylesheet" id="css-theme" href="assets/css/themes/'.Theme.'">'; } ?>
</head>
<body>
<div id="page-container" class="sidebar-o <?php echo Header; ?> enable-page-overlay side-scroll <?php echo Sidebar; ?> <?php echo PageHeader; ?> <?php echo Sidebar_Min; ?> <?php echo Sidebar_Pos; ?> <?php echo Header; ?> <?php echo MainContent; ?>">
<?php require_once('main_nav.php'); ?>

<main id="main-container">

<div class="content">
<?php require_once('../const/check-reply.php'); ?>
<div class="block block-rounded">
<div class="block-header block-header-default">
<h3 class="block-title">
Active Tickets
</h3>
<a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" href="staff?page=tickets">All</a>&nbsp;
<a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" href="staff?page=active_tickets">Active</a>&nbsp;
<a class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" href="staff?page=closed_tickets">Closed</a>&nbsp;
</div>
<div class="block-content block-content-full">
<table class="table table-bordered table-vcenter js-dataTable-buttons">
<thead>
<tr>
<th>Ticket ID</th>
<th>Customer Name</th>
<th>Customer Contact</th>
<th>Ticket Subject</th>
<th>Ticket Description</th>
<th>Ticket Category</th>
<th>Open Date</th>
<th style="width: 5%;">Status</th>
<th style="width: 5%;"></th>
</tr>
</thead>
<tbody>

<?php
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_tickets LEFT JOIN tbl_ticket_categories ON tbl_tickets.category = tbl_ticket_categories.id LEFT JOIN tbl_users ON tbl_tickets.member_id = tbl_users.id WHERE tbl_tickets.status = '1' AND tbl_tickets.assigned_to = ? ORDER BY tbl_tickets.id");
$stmt->execute([$account_id]);
$result = $stmt->fetchAll();

foreach($result as $row)
{
?>
<tr>
<td class="">
<?php echo $row[1]; ?>-<?php echo $row[0]; ?>
</td>
<td class="">
<?php echo $row[14]; ?> <?php echo $row[15]; ?>
</td>
<td class="">
<?php echo $row[17]; ?>
</td>
<td class="">
<?php echo $row[3]; ?>
</td>
<td class="" align="center">
<button type="button" data-bs-toggle="modal" data-bs-target="#modal-default-vcenter<?php echo $row[0]; ?>" class="btn btn-sm btn-alt-info">View Description</button>
</td>
<td class="">
<?php echo $row[11]; ?>
</td>
<td class="">
<?php echo $row[5]; ?>
</td>
<td class=" text-center">
<?php
switch ($row[8]) {
case '0':
?><span class="badge bg-warning">Pending</span><?php
break;

case '1':
?><span class="badge bg-success">Active</span><?php
break;

case '2':
?><span class="badge bg-danger">Closed</span><?php
break;
}
?>
</td>


<td class=" text-center">
<?php
switch ($row[8]) {
case '0':
?>
<?php
break;

case '1':
?>
<div class="btn-group">
<a class="btn btn-sm btn-alt-primary js-bs-tooltip-enabled" href="staff?page=ticket-detail&id=<?php echo $row[0]; ?>">
View
</a>
<?php
break;

case '2':
?>
<div class="btn-group">
<a class="btn btn-sm btn-alt-primary js-bs-tooltip-enabled" href="staff?page=ticket-detail&id=<?php echo $row[0]; ?>">
View
</a>
<?php
break;
}
?>
</td>
</tr>

<div class="modal" id="modal-default-vcenter<?php echo $row[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-default-vcenter<?php echo $row[0]; ?>" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Ticket Description</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body pb-1">
<p><?php echo $row[4]; ?></p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<?php
}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
?>



</tbody>
</table>
</div>
</div>
</div>


</main>

</div>
<script src="assets/js/lib/jquery.min.js"></script>
<script src="assets/js/dashmix.app.min-5.4.js"></script>
<script src="assets/loader/waitMe.js"></script>
<script src="assets/js/forms.js"></script>
<script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="assets/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
<script src="assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
<script src="assets/js/plugins/datatables-buttons/buttons.print.min.js"></script>
<script src="assets/js/plugins/datatables-buttons/buttons.html5.min.js"></script>
<script src="assets/js/pages/be_tables_datatables.min.js"></script>
<script>

function set_ticket(id, tick_id, author, name, phone, subject, category, date) {
document.getElementById('id2').value = id;
document.getElementById('author2').value = author;
document.getElementById('ticket_id2').innerHTML = tick_id;
document.getElementById('customer2').innerHTML = name;
document.getElementById('contact2').innerHTML = phone;
document.getElementById('subject2').innerHTML = subject;
document.getElementById('category2').innerHTML = category;
document.getElementById('open_date2').innerHTML = date;
}

function set_ticket2(id, tick_id, author, name, phone, subject, category, date) {
document.getElementById('id').value = id;
document.getElementById('author').value = author;
document.getElementById('ticket_id').innerHTML = tick_id;
document.getElementById('customer').innerHTML = name;
document.getElementById('contact').innerHTML = phone;
document.getElementById('subject').innerHTML = subject;
document.getElementById('category').innerHTML = category;
document.getElementById('open_date').innerHTML = date;
}
</script>
</body>
</html>
