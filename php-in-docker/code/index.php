<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <title>Hello World</title>

        <link href="//cdn.bootcss.com/semantic-ui/2.2.2/semantic.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="home.css">
        <link rel="shortcut icon" href="http://php.net/favicon.ico">

        <style type="text/css">
            body {
              position: relative;
              overflow: hidden;
              text-align: center;
              padding: 0em;
              color: rgba(255, 255, 255, 0.9);
              margin-bottom: 0px;
              border-bottom: none;

              background-color: #2A2A2A;
              background-image: radial-gradient(farthest-corner, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.3));
              background-position: 50% 50%;
              -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);

              animation: change_background_color 3s forwards;
            }

            .index {
              margin: 0em;
              padding: 15rem 0em;
            }

            #example.index h1 {
              font-size: 3em;
              color: #FFFFFF;
              line-height: 1.2;
              margin: 0px 0px 0px;
              padding-bottom: 0px;
              -moz-perspective: 500px;
              -webkit-perspective: 500px;
              perspective: 500px;
              -moz-transform-style: preserve-3d;
              -webkit-transform-style: preserve-3d;
              transform-style: preserve-3d;
            }
            #example.index h1 > .library {
              visibility: hidden;
              display: block;
              font-size: 2em;
              color: #FFFFFF;
              font-weight: bold;
            }
            #example.index code {
              font-family: inherit;
              font-size: smaller;
              color: rgba(255, 255, 255, 0.7);
            }

            @keyframes change_background_color {
              from {background-color: #2A2A2A;}
              to {background-color:#8892BF;}
            }
        </style>
    </head>

    <body id="example" class="index">
        <div class="introduction">
            <h1 class="ui inverted header">
            <span class="library">
                PHP in Docker
            </span>
            </h1>
            <div class="ui hidden divider"></div>
            <div class="ui large buttons">
                <a href="/info.php" class="ui basic inverted button">
                    <i class="left chevron icon"></i>
                    PHP info
                </a>
                <div class="or"></div>
                <a href="probe.php" class="ui basic inverted button">
                    PHP probe
                    <i class="right chevron icon"></i>
                </a>
            </div>
        </div>
        <div class="introduction">
            <p></p>
            <p>PHP7,&nbsp;&nbsp;Apache2.4,&nbsp;&nbsp;MySQL5.7</p>
            <code>new PDO('mysql:host=mysql;port=<?=getenv('MYSQL_PORT_3306_TCP_PORT')?>;dbname=<?=getenv('MYSQL_ENV_MYSQL_DATABASE')?>', '<?=getenv('MYSQL_ENV_MYSQL_USER')?>', '<?=getenv('MYSQL_ENV_MYSQL_PASSWORD')?>');</code>
        </div>

        <script src="//cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
        <script src="//cdn.bootcss.com/semantic-ui/2.2.2/semantic.min.js"></script>

        <script type="text/javascript">
            $('#example .library').transition({
                animation  : 'scale',
                duration   : '3s'
            });
        </script>
    </body>
</html>