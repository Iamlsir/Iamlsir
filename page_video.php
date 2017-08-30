<?php
/**
 * 摄像机
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>
    <div class="content">
    <ul class="postlist">
    <li class="posttitle" data-postid="<?php $this->cid() ?>">
        <h1>
            <a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
        </h1>
    </li>
    <li class="postcontent">
        <div id="yes" class="green" style="display: none;">本页面使用 Html5 接口,调用摄像头.如出现权限申请,请点击允许!</div>
        <div id="sorry" class="yellow" style="display: none">抱歉,您的浏览器不支持,请使用 Chrome,Firefox,Opera 等现代浏览器查看页面效果.</div>
        <div id="error" class="red" style="display: none;"></div>
        <button id="snap" class="a_demo_three" style="display: none;">拍照</button>
        <video id="video" width="100%" height="480" autoplay></video>
        <div id="cantip"></div>
        <script type="text/javascript">
        window.addEventListener("DOMContentLoaded", function () {
            var video = document.getElementById("video"),
                videoObj = {"video": true},
            errBack = function (error) {
                var err = document.getElementById("error");
//                console.log(error);
                document.getElementById("yes").style.display = "none";
                if ( error.name == 'DevicesNotFoundError' || error.name == 'NotFoundError') (err.innerText = "抱歉,没有检测到摄像头!") && (err.style.display = "block");
                if ( error.name == 'NotAllowedError') (err.innerText = "没有权限访问摄像头,如果想正常使用本页面功能,请刷新页面,并选择允许!") && (err.style.display = "block");
            };
            snap = function(){
                document.getElementById("yes").style.display = "block";
                document.getElementById("snap").style.display = "block";
                document.getElementById("snap").addEventListener("click", function () {
                    var date = (new Date()).valueOf();
                    var cns = document.createElement("canvas");
                    var tip = document.getElementById("cantip");
                    cns.width = 640;
                    cns.height = 480;
                    cns.id = "canvas_"+date;
                    console.log(cns,tip);
                    tip.insertBefore(cns,tip.childNodes[0]);
                    context = cns.getContext("2d");
                    context.drawImage(video, 0, 0, 640, 480);
                });
            };
            if (navigator.webkitGetUserMedia) { // WebKit-prefixed
                navigator.webkitGetUserMedia(videoObj, function (stream) {
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                    snap();
                }, errBack);
            } else if (navigator.getUserMedia) { // Standard
                navigator.getUserMedia(videoObj, function (stream) {
                    video.src = stream;
                    video.play();
                    snap();
                }, errBack);
            }
            else if (navigator.mozGetUserMedia) { // Firefox-prefixed
                navigator.mozGetUserMedia(videoObj, function (stream) {
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                    snap();
                }, errBack);
            }else{
                errBack();
                document.getElementById("yes").style.display = "none";
                document.getElementById("sorry").style.display = "block";
            }
        }, false);
        </script>
    </li>
    </ul>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>