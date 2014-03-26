<?php if (count($comments)>0) { ?>
    <div class="commentControl">
            <div class="commentHeader"><h2><?php echo Yii::t('CommentsModule.msg', 'Last comments');?></h2></div>
            <div class="commentResults">

                <?php foreach($comments as $comment) { ?>
                    <div class="commentItem">
                        <div class="commentName"><?=$comment->user->fullname?></div>
                        <div class="commentSpacer">-</div>
                        <div class="commentDate"><?php echo CHtml::encode(Y::dateFromTime($comment->create_time)); ?></div>
                        <div class="commentText">
                            <a href="<?=Yii::app()->createUrl('holes/view', array('id'=>$comment->owner_id, '#'=>'comment-'.$comment->id))?>"><?php if (mb_strlen($comment->comment_text) > $textLength) { $str=mb_substr($comment->comment_text,0,$textLength); echo nl2br(CHtml::encode(mb_substr($str,0,  mb_strrpos($str,' ')))).'...'; } else echo nl2br(CHtml::encode($comment->comment_text)); ?></a>
                        </div>
                    </div>
                <?php } ?>

            </div>
    </div>
<?php } ?>
