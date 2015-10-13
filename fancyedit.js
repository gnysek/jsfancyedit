(function ($) {

	var editors = [];
	var buttons = [];
	var id = 1;

	$.fn.fancyedit = function (options) {

		var settings = $.extend($.fn.fancyedit.defaults, options);
		settings.container = this;


		var addEditor = function (type) {
			id++;

			var container = $('<div/>', {class: 'editors', id: '__editor_' + id, 'data-type': type});

			switch (type) {
				case 'text':
					container.append('<textarea/>');
					break;
				case 'video':
					container.append('video url: ');
					container.append($('<input/>', {type: 'text', name: 'video__' + id, value: 'https://youtube.com/watch?v=yyFY0c-eVxA'}));
					container.append($('<button/>', {type: 'button', 'data-action': 'video-save', text: 'Save'}));
					container.append('<div class="video-img"><div data-action="video-img"></div><div class="video-url" data-action="video-url"></div></div>');
					break;
				case 'twitter':
					container.append('Tweet url: <input type="text" name="video__' + id + '">');
					break;
				case 'link':
					container.append('Link: <input type="text" name="video__' + id + '">');
					break;
				case 'separator':
					container.append('<div class="nextpage"><div class="np1"></div><div class="np2"></div><span></span></div>');
					break;
				default:
					container.append($('<div/>', {text: 'Unknown type ' + type}));
			}

			var footer = [
				"<br/>",
				"<button class='up-button'>UP</button>",
				"<button class='down-button'>DOWN</button>",
				"<button class='delete-button'>DELETE</button>",
				"</div>"];

			container.append(footer.join("\r\n"));

			settings.container.find('.fancy-buttons').before(container);

			pagesEnumerate();
		};

		var pagesEnumerate = function () {
			settings.container.find('.nextpage span').each(function (i, o) {
				$(o).text(i + 1);
			});
		}

		var toolbar = $('<div/>', {class: 'fancy-buttons'});

		if (settings.text) {
			toolbar.append($('<a/>', {text: '+Text'}).click(function () {
				addEditor('text');
			}));
		}
		if (settings.video) {
			toolbar.append($('<a/>', {text: '+video'}).click(function () {
				addEditor('video');
			}));
		}
		if (settings.image) {
			toolbar.append($('<a/>', {text: '+Image'}).click(function () {
				addEditor('image');
			}));
		}
		if (settings.link) {
			toolbar.append($('<a/>', {text: '+Link'}).click(function () {
				addEditor('link');
			}));
		}
		if (settings.twitter) {
			toolbar.append($('<a/>', {text: '+Twitter'}).click(function () {
				addEditor('twitter');
			}));
		}
		if (settings.separator) {
			toolbar.append($('<a/>', {text: '+Separator'}).click(function () {
				addEditor('separator');
			}));
		}

		toolbar.find('button').after(' ');

		$(settings.container).on('click', '.up-button', function () {
			$(this).parents('.editors').insertBefore($(this).parents('.editors').prev());
			pagesEnumerate();
		});

		$(settings.container).on('click', '.down-button', function () {
			$(this).parents('.editors').insertAfter($(this).parents('.editors').next());
			pagesEnumerate();
		});

		$(settings.container).on('click', '.delete-button', function () {
			$(this).parents('.editors').remove();
			pagesEnumerate();
		});

		$(settings.container).on('click', '[data-action="video-save"]', function () {
			var url = $(this).parents('.editors').find('input').val();
			var ytUrl = $.fn.fancyedit.videoParse(url);
			if (ytUrl.length > 0) {
				$(this).attr('data-action', 'video-edit').text('Edit');
				$(this).parents('.editors').find('input').attr('type', 'hidden');
				$(this).parents('.editors').find('[data-action="video-img"]').html(
					$('<a/>', {href: url, target: '_blank'}).css({backgroundImage: 'url(\'' + ytUrl + '\')'})//.append($('<img/>', {src: ytUrl}))
				);
				$(this).parents('.editors').find('[data-action="video-url"]').text(ytUrl + '<br/>' + url);
			}
		});

		$(settings.container).on('click', '[data-action="video-edit"]', function () {
			$(this).attr('data-action', 'video-save').text('Save');
			$(this).parents('.editors').find('input').attr('type', 'text');
			$(this).parents('.editors').find('[data-action="video-img"] a').remove();
			$(this).parents('.editors').find('[data-action="video-url"]').text('');
		});

		settings.container.append(toolbar);

		return this;
	};

	$.fn.fancyedit.defaults = {
		text: true,
		video: true,
		twitter: false,
		separator: true,
		link: true,
		image: true,

		container: this,
	};

	$.fn.fancyedit.videoParse = function (url) {
		var id = url.replace(/(.*watch\?v=)([a-zA-Z0-9_-])(.*?)/, '$2');
		if (id != url && id.length > 0) {
			return 'http://img.youtube.com/vi/' + id + '/sddefault.jpg';
		}
		return '';
	};

}(jQuery));
