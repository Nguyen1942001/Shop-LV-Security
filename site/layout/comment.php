<div class="post-comments">
    <ul class="media-list comments-list m-bot-50 clearlist">
        <?php foreach($comments as $comment): ?>
            <!-- Comment Item start-->
            <li class="media">
                <div class="media-body">
                    <div class="comment-info">
                        <h4 class="comment-author">
                            <p><?=$comment->getFullName()?></p>
                        </h4>
                        
                        <time datetime="2013-04-06T13:53"><?=$comment->getCreatedDate()?></time>
                    </div>

                    <p><?=$comment->getDescription()?></p>
                </div>
            </li>
            <!-- End Comment Item -->
        <?php endforeach ?>

    </ul>
</div>