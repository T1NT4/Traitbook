function initAnim(animationDataRaw){ 
    animationData = JSON.parse(animationDataRaw);


    var anim = lottie.loadAnimation({
    container: document.getElementById("lottie-animation"),
    renderer: "svg",
    loop: false,
    autoplay: false,
    animationData: animationData,
    });
    
    
    document
    .getElementById("lottie-animation")
    .addEventListener("mouseenter", function () {
        if (anim.isPaused == true) {
            anim.goToAndPlay(0, true);
        }
    });

    var svgthing = document.getElementById("illustration");
    svgthing.remove();
    var svgthing2 = document.getElementById("lottie-animation").children[0];
    svgthing2.style.height = "100%";
}