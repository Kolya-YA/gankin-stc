<?php
/**
 * Created by PhpStorm.
 * User: kolya_ya
 * Date: 06.02.2018
 * Time: 14:40
 *
 * @var $pageLink string link for share
 * @var $pageDescription string json encoded share description
 */
?>
<? if ($this->params['pageLink']) : ?>
<?
    $pageLink = $this->params['pageLink'];
    $pageDescription = isset($this->params['pageDescription']) ? $this->params['pageDescription'] : '';
?>
    <script type="text/javascript">
        let sharingWindow = null;

        function openSharingPopup(pageUrl, windowName) {
            if(sharingWindow == null || sharingWindow.closed) {
                sharingWindow = window.open(pageUrl, windowName,
                    "resizable,scrollbars,status, width=626, height=436");
            } else sharingWindow.focus();;
        }
    </script>

<div class="likes-block">

    <a href="https://www.facebook.com/sharer.php?u=<?=$pageLink;?>"
       target="facebook"
       rel="nofollow noopener noreferrer"
       onclick="openSharingPopup(this.href, this.target); return false;"
       class="likes-block__fb">
    </a>
<!--       onclick="window.open(this.href, this.target, 'width=626, height=436'); return false;"-->

    <a href="https://twitter.com/share?url=<?=$pageLink;?>&text=<?=urlencode($pageDescription);?>"
       target="twitter"
       rel="nofollow noopener noreferrer"
       onclick="openSharingPopup(this.href, this.target); return false;"
       class="likes-block__tw">
    </a>

    <a href="https://vkontakte.ru/share.php?url=<?=$pageLink;?>&description=<?=urlencode($pageDescription);?>"
       target="vkontakte"
       rel="nofollow noopener noreferrer"
       onclick="openSharingPopup(this.href, this.target); return false;"
       class="likes-block__vk">
    </a>

    <a href="https://plusone.google.com/_/+1/confirm?hl=ru&url=<?=$pageLink;?>"
       target="gplus"
       rel="nofollow noopener noreferrer"
       onclick="openSharingPopup(this.href, this.target); return false;"
       class="likes-block__gp">
    </a>

<!--    <a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl=--><?//=$pageLink;?><!--"-->
<!--       target="odnkl"-->
<!--       rel="nofollow noopener noreferrer"-->
<!--       onclick="openSharingPopup(this.href, this.target); return false;"-->
<!--       class="likes-block__ok">-->
<!--     </a>-->

</div>

<? endif; ?>