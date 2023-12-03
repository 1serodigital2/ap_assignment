<?php
$html = null;
$imgPath = "images/";
$img = "img1.webp||img2.webp||img3.webp";
$title = "Beautiful Nature One||Beautiful Nature Two||Beautiful Nature Three";
$para = "Beautiful Nature One sit amet consectetur adipisicing elit. Atque placeat, nisi quo at beatae quas reiciendis ipsa aperiam repellat obcaecati!||Beautiful Nature Two sit amet consectetur adipisicing elit. Atque placeat, nisi quo at beatae quas reiciendis ipsa aperiam repellat obcaecati!||Beautiful Nature Three sit amet consectetur adipisicing elit. Atque placeat, nisi quo at beatae quas reiciendis ipsa aperiam repellat obcaecati!";
$id = "1||2||3";

$imgExp = explode("||", $img);
$titleExp = explode("||", $title);
$paraExp = explode("||", $para);
$idExp = explode("||", $id);

foreach($idExp as $i=> $tid){
    $html .= '<div class="slide">
                <img src="'.$imgPath.$imgExp[$i].'" alt="">
                <div class="content_wrapper">
                    <h1>'.$titleExp[$i].'</h1>
                    <p>'.$paraExp[$i].'</p>
                    <a href="some-page.php?id='.$tid.'">Action Button</a>
                </div>
            </div>' ;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider</title>
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <section class="slider">
        <div class="counter_wrapper">
            <div class="counter">
                <span class="count-active">1</span>/
                <span class="total-count">3</span>
            </div>
            <div class="line"></div>
            <div class="arrows">
                <div class="arrowPrev">&larr;</div>
                <div class="arrowNext">&rarr;</div>
            </div>
        </div>
        <div class="slides_wrapper">
            <?php echo $html; ?>
        </div>
    </section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function () {

    var interval;
    interval = setInterval(function () {
    moveRight();
    }, 3000);

    $('.slider').mouseover(function(){
    clearInterval(interval);
    });

    $('.slider').mouseleave(function(){
    interval = setInterval(function () {
        moveRight();
        }, 3000);
    });

    var slideCount = $('.slider .slides_wrapper .slide').length;
    var slideWidth = $('.slider .slides_wrapper .slide').width();
    var slideHeight = $('.slider .slides_wrapper .slide').height();
    var sliderWrapperWidth = slideCount * slideWidth;
    var pauseAutoCalc = false;

    function updateCounter(checkAction) {
        var count = $(".count-active").text();
        var countEl = $(".count-active");
        if(checkAction == 'plus'){
            if(count < slideCount){
                countEl.text(parseInt(count)+1);
            }else{
                count = slideCount-1;
                if(count >= 1){
                    countEl.text(parseInt(count)-1);
                }
            }
        }else if(checkAction == 'minus'){
            if(count > 1 && count <= slideCount){
                countEl.text(parseInt(count)-1);
            }else{
                count = slideCount+1;
                if(count >= 1){
                    countEl.text(parseInt(count)-1);
                }
            }
        }
    }


    $('.slider').css({ width: slideWidth, height: slideHeight });

    $('.slider .slides_wrapper').css({ width: sliderWrapperWidth, marginLeft: - slideWidth });

    $('.slider .slides_wrapper .slide:last-child').prependTo('.slider .slides_wrapper');

    function moveLeft() {
        $('.slider .slides_wrapper').animate({
            left: +slideWidth
        }, 500, function () {
            $('.slider .slides_wrapper .slide:last-child').prependTo('.slider .slides_wrapper');
            $('.slider .slides_wrapper').css('left', '');
        });
    };

    function moveRight() {
        $('.slider .slides_wrapper').animate({
            left: -slideWidth
        }, 500, function () {
            $('.slider .slides_wrapper .slide:first-child').appendTo('.slider .slides_wrapper');
            $('.slider .slides_wrapper').css('left', '');
            if(pauseAutoCalc === false){
                updateCounter('plus');
            }
        });
    };

    $('.arrowPrev').click(function () {
        updateCounter('minus');
        moveLeft();
    });

    $('.arrowNext').click(function () {
        pauseAutoCalc = true;
        updateCounter('plus');
        moveRight();
    });

});    

</script>
</body>
</html>