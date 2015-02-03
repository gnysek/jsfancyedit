<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<style type="text/css">
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
</style>

<script type="text/javascript">
	var editors = [];
	var id = 1;
	function addEditor(type) {
		id++;
		var header = ["<div class='editors' id='__editor_" + id + "' data-type='text'>"];

		if (type == "video") {
			var inner = ['Youtube url: <input type="text" name="video__' + id + '">'];
		} else if (type == "tweet") {
			var inner = ['Tweet url: <input type="text" name="video__' + id + '">'];
		} else if (type == "link") {
			var inner = ['Link: <input type="text" name="video__' + id + '">'];
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
	}

	$().ready(function () {
		$('#buttons button').on('click', function () {
			addEditor($(this).data('type'));
		});

		$(document).on('click', '.up-button', function () {
			console.log('up');
			$(this).parents('.editors').insertBefore($(this).parents('.editors').prev());
		});

		$(document).on('click', '.down-button', function () {
			$(this).parents('.editors').insertAfter($(this).parents('.editors').next());
		});

		$(document).on('click', '.delete-button', function () {
			$(this).parents('.editors').remove();
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
</div>
