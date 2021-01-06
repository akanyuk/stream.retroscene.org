<?php
$files = array_diff(scandir("../rec/"), array('.', '..'));

if (empty($files)) {
	exit('No recordings founsd');
}

if (isset($_GET['file']) && $_GET['file'] && file_exists('../rec/'.$_GET['file'])) {
	$file = $_GET['file'];
} else {
	$file = reset($files);
}

$title = "RST5 / Recordings / ".formatName($file);

function formatName($file = "") {
        list($foo, $y, $mon, $d, $h, $min) = explode('-', $file);
        list($m, $foo) = explode('.', $min);
        return $y.'.'.$mon.'.'.$d.' '.$h.':'.$m;
}
?>
<!DOCTYPE html> 
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="/favicon.ico" rel="shortcut icon" />

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
                integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
                crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
                crossorigin="anonymous"></script>
        <link href="/cover.css" rel="stylesheet">

        <link href="https://unpkg.com/video.js/dist/video-js.min.css" rel="stylesheet">
        <script src="https://unpkg.com/video.js/dist/video.min.js"></script>
        <script src="https://unpkg.com/flv.js/dist/flv.min.js"></script>
        <script src="https://unpkg.com/videojs-flvjs/dist/videojs-flvjs.min.js"></script>

        <title><?php echo $title?></title>
<script>
$(document).ready(function(){
        const player = videojs('vid1', {autoplay: true});

        $('a[id="recording"]').click(function(e){
                e.preventDefault();

                $('a[id="recording"]').removeClass('active');
                $(this).addClass('active', 'active');

                window.history.pushState('', '<?php echo $title?>', $(this).attr('href'));

                player.src({src: "/rec/" + $(this).data('file'), type: "video/x-flv"});
                player.play();
        });
});
</script>
</head>
<body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Retroscene stream</h3>
                    <nav class="nav nav-masthead justify-content-center">
                        <a class="nav-link" href="/">Live</a>
                        <a class="nav-link active" href="/recordings">Recordings</a>
                    </nav>
            </div>
        </header>
        <main role="main" class="inner cover">
            <div class="row">
                <div class="col-md-10 col-sm-12">
                    <video-js id="vid1" class="vjs-default-skin vjs-fluid" controls>
                            <source src="/rec/<?php echo $file?>" type="video/x-flv">
                    </video-js>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="recording-links">
<?php foreach($files as $f): ?>
    <a id="recording" data-file="<?php echo $f?>" <?php echo $f == $file ? 'class="active"' : ''?> href="?file=<?php echo $f?>"><?php echo formatName($f)?></a>
<?php endforeach;?>
                    </div>
                </div>
            </div>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p></p>
            </div>
        </footer>
    </div>
</body>
</html>
