<?php
$page_title = 'Message';
$breadcrumb = ["Home", $page_title];
$header_assets = [
    '<link href="assets/css/profile.css" rel="stylesheet" type="text/css">',
    '<script src="assets/js/plugins/forms/validation/validate.min.js"></script>',
    '<script src="assets/js/pages/profile.js"></script>'
];

require('layouts/header.php');






?>
<div class="content">
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Line content divider</h5>
    </div>

    <div class="card-body">
        <div class="media-chat-scrollable mb-3">
            <ul class="media-list media-chat">
                <li class="media content-divider justify-content-center text-muted mx-0">
                    <span class="px-2">Monday, Feb 10</span>
                </li>

                <li class="media">
                    <div class="mr-3">
                        <a href="../../../../global_assets/images/demo/images/3.png">
                            <img src="../../../../global_assets/images/demo/users/face11.jpg" class="rounded-circle" alt="" width="40" height="40">
                        </a>
                    </div>

                    <div class="media-body">
                        <div class="media-chat-item">Crud reran and while much withdrew ardent much crab hugely met dizzily that more jeez gent equivalent unsafely far one hesitant so therefore.</div>
                        <div class="font-size-sm text-muted mt-2">Tue, 10:28 am <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                    </div>
                </li>

                <li class="media media-chat-item-reverse">
                    <div class="media-body">
                        <div class="media-chat-item">Thus superb the tapir the wallaby blank frog execrably much since dalmatian by in hot. Uninspiringly arose mounted stared one curt safe</div>
                        <div class="font-size-sm text-muted mt-2">Tue, 8:12 am <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                    </div>

                    <div class="ml-3">
                        <a href="../../../../global_assets/images/demo/images/3.png">
                            <img src="../../../../global_assets/images/demo/users/face1.jpg" class="rounded-circle" alt="" width="40" height="40">
                        </a>
                    </div>
                </li>

                <li class="media content-divider justify-content-center text-muted mx-0">
                    <span class="text-muted px-2">Today</span>
                </li>

                <li class="media media-chat-item-reverse">
                    <div class="media-body">
                        <div class="media-chat-item">Satisfactorily strenuously while sleazily dear frustratingly insect menially some shook far sardonic badger telepathic much jeepers immature much hey.</div>
                        <div class="font-size-sm text-muted mt-2">2 hours ago <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                    </div>

                    <div class="ml-3">
                        <a href="../../../../global_assets/images/demo/images/3.png">
                            <img src="../../../../global_assets/images/demo/users/face1.jpg" class="rounded-circle" alt="" width="40" height="40">
                        </a>
                    </div>
                </li>

                <li class="media">
                    <div class="mr-3">
                        <a href="../../../../global_assets/images/demo/images/3.png">
                            <img src="../../../../global_assets/images/demo/users/face11.jpg" class="rounded-circle" alt="" width="40" height="40">
                        </a>
                    </div>

                    <div class="media-body">
                        <div class="media-chat-item">Grunted smirked and grew less but rewound much despite and impressive via alongside out and gosh easy manatee dear ineffective yikes.</div>
                        <div class="font-size-sm text-muted mt-2">13 minutes ago <a href="#"><i class="icon-pin-alt ml-2 text-muted"></i></a></div>
                    </div>
                </li>

                <li class="media media-chat-item-reverse">
                    <div class="media-body">
                        <div class="media-chat-item"><i class="icon-menu"></i></div>
                    </div>

                    <div class="ml-3">
                        <a href="../../../../global_assets/images/demo/images/3.png">
                            <img src="../../../../global_assets/images/demo/users/face1.jpg" class="rounded-circle" alt="" width="40" height="40">
                        </a>
                    </div>
                </li>
            </ul>
        </div>

        <textarea name="enter-message" class="form-control mb-3" rows="3" cols="1" placeholder="Enter your message..."></textarea>

        <div class="d-flex align-items-center">
            <div>
                <a href="#" class="btn btn-light btn-icon border-transparent rounded-pill btn-sm mr-1" data-popup="tooltip" title="" data-original-title="Send photo"><i class="icon-file-picture"></i></a>
                <a href="#" class="btn btn-light btn-icon border-transparent rounded-pill btn-sm mr-1" data-popup="tooltip" title="" data-original-title="Send video"><i class="icon-file-video"></i></a>
                <a href="#" class="btn btn-light btn-icon border-transparent rounded-pill btn-sm mr-1" data-popup="tooltip" title="" data-original-title="Send file"><i class="icon-file-plus"></i></a>
            </div>

            <button type="button" class="btn btn-teal btn-labeled btn-labeled-right ml-auto"><b><i class="icon-paperplane"></i></b> Send</button>
        </div>
    </div>
</div>
</div>

<?php include_once 'layouts/footer.php';
