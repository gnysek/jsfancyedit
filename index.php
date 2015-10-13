<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<style type="text/css">
	body {
		font-family: Verdana;
		font-size: 12px;
	}

	.editors, #buttons, .fancy-buttons {
		padding: 10px;
		background: #fafafa;
	}

	.editors {
		border: 2px solid #F5f5f5;
		border-bottom-color: gray;
		margin: 5px 0;
	}

	.editors:hover {
		border: 2px solid green;
	}

	#buttons, .fancy-buttons {
		text-align: center;
	}

	.fancy-buttons a {
		padding: 5px;
		display: inline-block;
		border: 1px solid gray;
		margin: 0 5px;
	}

	.fancy-buttons a:hover {
		background: black;
		color: white;
		cursor: pointer;
	}

	.video-img {
		position: relative;
		text-align: center;
	}

	.video-img a {
		width: 400px;
		height: 225px;
		display: inline-block;
		position: relative;
		background: black center center;
		background-size: cover;
	}

	.video-img a:hover {
		opacity: 0.9;
	}

	.video-img a:before {
		content: "";
		width: 100%;
		height: 100%;
		position: absolute;
		left: 0px;
		top: 0px;
		background: transparent url('youtube.png') no-repeat center center;
	}

	.video-url {
		font-size: 10px;
		padding: 4px;
	}

	textarea {
		width: 100%;
		height: 150px;
	}

	.nextpage > div {
		border-bottom: 2px solid #000;
		width: 48%;
		height: 5px;
	}

	.nextpage .np1 {
		float: left;
	}

	.nextpage .np2 {
		float: right;
	}

	.nextpage span {
		text-align: center;
		display: block;
	}
</style>

<div id="editor"></div>
<div id="ftest"></div>

<script src="fancyedit.js"></script>
<script>
	$().ready(function () {
		$('#editor').fancyedit();
		$('#ftest').fancyedit({buttons: 'text,video,embed'});
	});
</script>


