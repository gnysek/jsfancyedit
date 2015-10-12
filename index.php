<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<style type="text/css">
	body {
		font-family: Verdana;
		font-size: 12px;
	}

	.editors, #buttons {
		padding: 10px;
		background: #fafafa;
	}

	.editors {
		border: 2px solid #F5f5f5;
		margin: 5px 0;
	}

	.editors:hover {
		border: 2px solid green;
	}

	#buttons {
		text-align: center;
	}

	.youtube-img {
		position: relative;
		text-align: center;
	}

	.youtube-img img {
		width: 400px;
		height: 300px;
		background: black;;
	}

	.youtube-img span:before {
		content: "";
		width: 100%;
		height: 100%;
		position: absolute;
		left: 0px;
		top: 0px;
		background: transparent url('youtube.png') no-repeat center center;
	}

	textarea {
		width: 100%;
		height: 150px;
	}

	.nextpage > div {
		border-top: 2px solid black;
		width: 40%;
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

<script type="text/javascript">
	var editors = [];
	var id = 1;
	function addEditor(type) {
		id++;
		var header = ["<div class='editors' id='__editor_" + id + "' data-type='text'>"];

		if (type == "video") {
			var inner = ['Youtube url: <input type="text" name="video__' + id + '" value="https://www.youtube.com/watch?v=yyFY0c-eVxA">', '<button type="button" data-action="video-save">Save</button>', '<div class="youtube-img"><span data-action="video-img"></span><div data-action="video-url"></div></div>'];
		} else if (type == "tweet") {
			var inner = ['Tweet url: <input type="text" name="video__' + id + '">'];
		} else if (type == "link") {
			var inner = ['Link: <input type="text" name="video__' + id + '">'];
		} else if (type == "nextpage") {

			if ($('#editor .editors').length > 0) {
				if ($('#editor .editors').last().data('type') == type) {
					alert('There cant be page separator after another page separator');
					return;
				}
			}

			var inner = ['<div class="nextpage"><div class="np1"></div><div class="np2"></div><span></span></div>'];
		} else {
			var inner = ['<textarea></textarea>'];
		}

		var footer = [
			"<br/>",
			"<button class='up-button'>UP</button>",
			"<button class='down-button'>DOWN</button>",
			"<button class='delete-button'>DELETE</button>",
			"</div>"];

		var result = [].concat(header, inner, footer);

		var editor = $(result.join("\r\n"));
		$('#editor').append(editor);

		pagesEnumerate();
	}

	function pagesEnumerate() {
		$('.nextpage span').each(function (i, o) {
			$(o).text(i + 1);
		});
	}

	function youtubeImage(url) {
		// ex. https://www.youtube.com/watch?v=yyFY0c-eVxA
		var id = url.replace(/(.*watch\?v=)([a-zA-Z0-9_-])(.*?)/, '$2');
		if (id != url && id.length > 0) {
			return 'http://img.youtube.com/vi/' + id + '/sddefault.jpg';
		}
		return '';
	}

	$().ready(function () {
		$('#buttons button').on('click', function () {
			addEditor($(this).data('type'));
		});

		$(document).on('click', '.up-button', function () {
			$(this).parents('.editors').insertBefore($(this).parents('.editors').prev());
			pagesEnumerate();
		});

		$(document).on('click', '.down-button', function () {
			$(this).parents('.editors').insertAfter($(this).parents('.editors').next());
			pagesEnumerate();
		});

		$(document).on('click', '.delete-button', function () {
			$(this).parents('.editors').remove();
			pagesEnumerate();
		});

		$(document).on('click', '[data-action="video-save"]', function () {
			var url = $(this).parents('.editors').find('input').val();
			var ytUrl = youtubeImage(url);
			if (ytUrl.length > 0) {
				$(this).attr('data-action', 'video-edit').text('Edit');
				$(this).parents('.editors').find('input').attr('type', 'hidden');
				$(this).parents('.editors').find('[data-action="video-img"]').html($('<img/>', {src: ytUrl}));
				$(this).parents('.editors').find('[data-action="video-url"]').text(ytUrl);
			}
		});

		$(document).on('click', '[data-action="video-edit"]', function () {
			$(this).attr('data-action', 'video-save').text('Save');
			$(this).parents('.editors').find('input').attr('type', 'text');
			$(this).parents('.editors').find('[data-action="video-img"] img').remove();
			$(this).parents('.editors').find('[data-action="video-url"]').text('');
		});
	});
</script>

<div id="editor">
</div>
<div id="buttons">
	<button data-type="text">+ TXT</button>
	<button data-type="video">+ VID</button>
	<button data-type="tweet">+ TWEET</button>
	<button data-type="link">+ LINK</button>
	<button data-type="nextpage">+ PAGE SEPARATOR</button>
</div>
