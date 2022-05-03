<?php
$page_title = 'User Profile';
$breadcrumb = ["Home", $page_title];
$header_assets = [
    '<link href="assets/css/profile.css" rel="stylesheet" type="text/css">',
    '<script src="assets/js/plugins/forms/validation/validate.min.js"></script>',
    '<script src="assets/js/pages/profile.js"></script>'
];

require('layouts/header.php');
?>






<?php include_once('layouts/footer.php');
