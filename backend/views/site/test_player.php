<?php
/* @var $this yii\web\View */

use yii\web\View;

setViewParam('liActive', 'test_player');
$this->title = t(Yii::$app->params['title']).' ' .user()->fullName.' ' .t('Test Player');
?>
<div class="site-index">
    <div class="panel panel-default">
        <div class="panel-body">
            <div style="">
                <div id="player" style=""></div>
            </div>
        </div>
    </div>
</div>

<?php header('Access-Control-Allow-Origin: *'); ?>

<?php $this->registerJsFile('@web/js/jwplayer-7.12.6/jwplayer.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>

<script>
    window.video_id = <?= json_encode(1) ?>;
    window.video_type = <?= json_encode(4) ?>;
    window.player_title = <?= json_encode('test video title') ?>;
    window.player_description = <?= json_encode('test video description') ?>;
    window.video1 = <?= json_encode(imageURL("test_video/1.mp4")) ?>;
    window.video2 = <?= json_encode(imageURL("test_video/2.mp4")) ?>;
    window.video3 = <?= json_encode(imageURL("test_video/3.mp4")) ?>;
    window.image = <?= json_encode(imageURL("test_video/test_image.jpeg")) ?>;
    window.adv_client = <?= json_encode('none') ?>;
    window.adv_tag = <?= json_encode('none') ?>;
</script>

<script>
    window.playlist = [
        {
            "image": window.image,
            "title": window.player_title,
            "sources": [{
                "file": window.video1,
                "label": "480p"
            }, {
                "file": window.video2,
                "label": "720p"
            }, {
                "file": window.video3,
                "label": "HD"
            }]
        }
    ];
    window.playlist_ids = [];
    window.playlist_ids.push(<?= json_encode(1) ?>);
</script>
<?php foreach ([] as $key => $one_video) { ?>
    <script>
        window.playlist.push({"file": window.video1, "title": <?= json_encode($one_video->name) ?>, "image": <?= json_encode($one_video->wideImageUrl) ?>});
        window.playlist_ids.push(<?= json_encode($one_video->id) ?>);
    </script>
<?php } ?>
<?php
$script = <<< JS
    jwplayer.key = "CNx+a+kqZJlL3Wfl8sw/sO3h8k4yQlbX8nCZ867QH3o=";
    var player = jwplayer('player');

    var file = window.video;
    player.setup({
        width: '100%',
        height: 410,
        logo: {
            position : 'bottom-right',
        file: url+'/images/logo.png',
    },
        advertising: {
                client: window.adv_client,
                tag: window.adv_tag
            },
        "playlist": window.playlist,
    });    
        
        var counter = 0;
        var time = 0;
        player.onTime(function(event){
            var time= Math.floor(event.position);

            if (time == counter){
                counter+=5;
                // $.get(url+'/en/site/save-player-ontime', {id : window.video_id, video_type: window.video_type}, function(data){
                //     if(data != null)
                //     {
                //         if(data != 'save'){
                //             player.stop(true);
                //             location.reload();
                //         }
                //     } 
                // });    
            }
        });
        
        player.onPlaylistItem(function(){
            var thisVideo = player.getPlaylistIndex();
            if(thisVideo != 0){
                // window.location.href = url + '/series-episode/view?id='+window.playlist_ids[thisVideo];
            }
        });

JS;
$this->registerJs($script);
?>



