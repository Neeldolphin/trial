<div id="content">
	
<div class="box1" style="background-color: rgb(102, 103, 238);"></div><div class="box1" style="background-color: rgb(248, 27, 33);"></div><div class="box1" style="background-color: rgb(145, 35, 237);"></div><div class="box1" style="background-color: rgb(218, 4, 52);"></div><div class="box1" style="background-color: rgb(254, 177, 238);"></div><div class="box1" style="background-color: rgb(156, 92, 178);"></div><div class="box1" style="background-color: rgb(204, 25, 66);"></div><div class="box1" style="background-color: rgb(70, 211, 169);"></div><div class="box1" style="background-color: rgb(173, 228, 195);"></div><div class="box1" style="background-color: rgb(27, 206, 109);"></div><div class="box1" style="background-color: rgb(142, 190, 205);"></div><div class="box1" style="background-color: rgb(232, 107, 184);"></div><div class="box1" style="background-color: rgb(238, 99, 168);"></div><div class="box1" style="background-color: rgb(249, 218, 239);"></div><div class="box1" style="background-color: rgb(29, 158, 193);"></div><div class="box1" style="background-color: rgb(239, 155, 133);"></div><div class="box1" style="background-color: rgb(63, 133, 149);"></div><div class="box1" style="background-color: rgb(127, 157, 26);"></div></div>
<div id="loader" class="active">
	<img src="../../assets/img/example_loading.gif">
	LOADING...
</div>
<script>
	// init controller
	var controller = new ScrollMagic.Controller();

	// build scene
	var scene = new ScrollMagic.Scene({triggerElement: ".dynamicContent #loader", triggerHook: "onEnter"})
					.addTo(controller)
					.on("enter", function (e) {
						if (!$("#loader").hasClass("active")) {
							$("#loader").addClass("active");
							if (console){
								console.log("loading new items");
							}
							// simulate ajax call to add content using the function below
							setTimeout(addBoxes, 1000, 9);
						}
					});

	// pseudo function to add new content. In real life it would be done through an ajax request.
	function addBoxes (amount) {
		for (i=1; i<=amount; i++) {
			var randomColor = '#'+('00000'+(Math.random()*0xFFFFFF<<0).toString(16)).slice(-6);
			$("<div></div>")
				.addClass("box1")
				.css("background-color", randomColor)
				.appendTo(".dynamicContent #content");
		}
		// "loading" done -> revert to normal state
		scene.update(); // make sure the scene gets the new start position
		$("#loader").removeClass("active");
	}

	// add some boxes to start with.
	addBoxes(18);
</script>