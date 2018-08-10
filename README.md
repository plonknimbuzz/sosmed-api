# Sosmed API

## Authentication
 - Login ke *web xxx* dengan user dan password yang diberikan, lalu dapatkan token anda.
 - Silahkan regenerate token jika diperlukan

## Tools SosmedAPI class
Anda bisa menggunakan tools/library manapun, atau juga bisa menggunakan native curl php. Akan tetapi sudah disediakan simple wrapper class untuk memanggil API ini. Class ini dibuat berdasarkan [php-curl-class](https://github.com/php-curl-class/php-curl-class) sehingga jika ingin dikembangkan bisa lebih mudah dilakukan.  

Download dan Include class SosmedAPI seperti berikut:
```php
<?php
require_once 'SosmedAPI.php';
$token = 'xxxxxx';
$apiUrl = 'http://api.domain.com';
//init class
$obj = new SosmedAPI($apiUrl);
$obj->setToken($token);

$obj->api((string) WEB_CODENAME, (string) REQUEST_TYPE, (array) REQUEST_PARAM);

//example
$resultIg = $obj->api('ig', 'user_info', ['userId'=> 23232323]);
$resultTw = $obj->api('tw', 'search', ['keyword'=> 'php', 'language'=> 'en']);

```
## API documentation 

### Web Code
Ini adalah kode web yang disupport oleh SosmedAPI

| Web | Code |
| --- | --- |
| Instagram | ig |
| Twitter | tw |
| Youtube | yt |
| Facebook | fb |

### API Instagram 
#### User Info
Untuk mendapatkan info dari user berdasarkan userid ataupun username (salah satunya saja).

| Param | Type | Keterangan |
| --- | --- | --- |
| userId | big int | **required** valid instagram userid (*prefer*) |
| userName | string | **required** valid instagram username |

output:
```json
{
	"ok": 0,
	"data": {
		"smd_type": "instagram",
		"user_info": {
			"user_id": "3130279xxx",
			"username": "plonknimbuzz",
			"full_name": "Plonk Nimbuzz",
			"profile_picture": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/bbddf1sxxxx.jpg",
			"is_private_account": false,
			"is_verified_account": false,
			"is_business_account": true,
			"phone": {
				"public_phone_number": "+62812900xxxxx",
				"contact_phone_number": "+62812900xxxx"
			},
			"public_email": "plonknimbuzz@gmail.com",
			"biography": "ini bio",
			"website": "http://example.com/",
			"is_related_to_fb": true,
			"facebook_page": "https://facebook.com/30900xxxx"
		}
	}
}
```


#### Media Info
Untuk mendapatkan informasi dari suatu media /postingan di Instagram baik berupa photo, video maupun album.

| Param | Type | Keterangan |
| --- | --- | --- |
| mediaId | string | **required** valid instagram media id (*prefer*) |
| mediaUrl | string | **required** valid instagram media url |

```json
{
	"ok": 0,
	"data": {
		"smd_type": "instagram",
		"media": {
			"post_time": "1532821xx",
			"media_id": "183376217410569xxxx",
			"like_count": 5,
			"comment_count": 0,
			"media_type": "photo",
			"media_url": "https://www.instagram.com/p/Bly1Pxxxx/?taken-by=plonknimbuzz",
			"is_reshareable": true,
			"is_caption_edited": false,
			"is_comment_like_disabled": true,
			"file": [
				{
					"width": 900,
					"height": 600,
					"url": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/xxx.jpg"
				},
				{
					"width": 240,
					"height": 160,
					"url": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/xxx.jpg"
				}
			],
			"caption": "indo",
			"posted_user_info": {
				"user_id": "3130279xxx",
				"username": "plonknimbuzz",
				"full_name": "Plonk Nimbuzz",
				"is_private_account": false,
				"profile_picture": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/xxx.jpg",
				"is_verified_account": false
			},
			"is_can_be_saved": true
		}
	}
}
```

#### Media Likers
Untuk mendapatkan user-user yang melakukan like terhadap media/postingan tersebut.

| Param | Type | Keterangan |
| --- | --- | --- |
| mediaId | string | **required** valid instagram media id (*prefer*) |
| mediaUrl | string | **required** valid instagram media url |

```json
{
	"ok": 0,
	"data": {
		"smd_type": "instagram",
		"media_id": "1833762174105693829_31302xxxx",
		"media_url": "https://www.instagram.com/p/Bly1PtOxxx/?taken-by=plonknimbuzz",
		"like_count": 5,
		"likers": [
			{
				"pk": "61865xxx",
				"username": "ggggxxx",
				"full_name": "Ilham xxxx",
				"is_private": false,
				"is_verified": false,
				"profile_pic_url": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/xxx.jpg",
				"profile_pic_id": "1821882780592566346_618xxxx",
				"latest_reel_media": "153382xxxx"
			},
			{
				"pk": "314716xxx",
				"username": "exploxxxx",
				"full_name": "Explxxxx",
				"is_private": false,
				"is_verified": false,
				"profile_pic_url": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/xxx.jpg"
			},
			...
		]
	}
}
```


##### Media Comments
Untuk mendapatkan comment-comment pada suatu media/postingan tersebut.

| Param | Type | Keterangan |
| --- | --- | --- |
| mediaId | string | **required** valid instagram media id (*prefer*) |
| mediaUrl | string | **required** valid instagram media url |

```json
{
	"ok": 0,
	"data": {
		"smd_type": "instagram",
		"media_id": "1842087123282634027_328640xxx",
		"media_url": "https://www.instagram.com/p/BmQaHqxxx/?tagged=jokowi",
		"comment_count": 2286,
		"has_more_comments": false,
		"has_more_headload_comments": true,
		"next_min_id": "{\"cached_comments_cursor\": \"17860458280xxx\", \"bifilter_token\": \"KKEBAIS9VGyFtj8Axxi78xxxx\"}",
		"comment_likes_enabled": true,
		"comments": [
			{
				"comment_id": "178900354422xxxx",
				"comment_post_time": "1533814218",
				"text": "Padahal bagusan Mahfud MD. Mungkin ini cara Jokowi redam issu anti ....",
				"user": {
					"user_id": "20146xxxx",
					"username": "utxx",
					"full_name": "Utho xxx",
					"is_private_account": true,
					"is_verified_account": false,
					"profile_picture": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/b54d07fcfc5cb28435xx.jpg"
				},
				"did_report_as_spam": false,
				"has_liked_comment": false,
				"comment_like_count": 607,
				"child_comment_count": 70
			},
			{
				"comment_id": "1795347409xxx",
				"comment_post_time": "1533814508",
				"text": "LJangan campur politik dan unsur agama” eh skrang malah pemuka agama ...",
				"user": {
					"user_id": "2098265xxx",
					"username": "m.alaxxx",
					"full_name": "Muhammadxxx",
					"is_private_account": false,
					"is_verified_account": false,
					"profile_picture": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/4c46b101a.jpg"
				},
				"did_report_as_spam": false,
				"has_liked_comment": false,
				"comment_like_count": 371,
				"child_comment_count": 96
			},
			...
		]
	}
}
```
#### User Story
Untuk mendapatkan user story yang paling baru


```json
{
	"ok": 0,
	"data": {
		"smd_type": "instagram",
		"id": "8308483xxx",
		"latest_reel_media": "153386xxx",
		"expiring_at": 1533950219,
		"seen": "1533857666",
		"can_reply": true,
		"can_reshare": true,
		"reel_type": "user_reel",
		"user": {
			"pk": "830848xxx",
			"username": "hakixxx",
			"full_name": "I   xxx",
			"is_private": false,
			"profile_pic_url": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/8f848xxx.jpg",
			"profile_pic_id": "1833386419454626894_83084xxx",
			"friendship_status": {
				"following": true,
				"followed_by": false,
				"blocking": false,
				"muting": false,
				"is_private": false,
				"incoming_request": false,
				"outgoing_request": false,
				"is_bestie": false
			},
			"is_verified": false
		},
		"items": [
			{
				"taken_at": "1533822620",
				"pk": "184216015714xxxx",
				"id": "1842160157145334637_83084xxxx",
				"device_timestamp": "3131785595798",
				"media_type": 1,
				"code": "BmQqucaxxxx",
				"client_cache_key": "MTg0MjE2MDE1NzE0NTMzNDYxxx",
				"filter_type": 0,
				"image_versions2": {
					"candidates": [
						{
							"width": 1080,
							"height": 1920,
							"url": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/ff8691a3aba370669"
						},
						{
							"width": 240,
							"height": 426,
							"url": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/5823bd5e98"
						}
					]
				},
				"original_width": 1080,
				"original_height": 1920,
				"caption_position": 0,
				"is_reel_media": true,
				"user": {
					"pk": "8308483xxx",
					"username": "hakxxx",
					"full_name": "I xxxxN",
					"is_private": false,
					"profile_pic_url": "https://instagram.fcgk10-1.fna.fbcdn.net/vp/8f8489ef.jpg",
					"profile_pic_id": "1833386419454626894_83084xxx",
					"is_verified": false,
					"has_anonymous_profile_picture": false,
					"reel_auto_archive": "unset",
					"is_unpublished": false,
					"is_favorite": false
				},
				"caption": null,
				"caption_is_edited": false,
				"photo_of_you": false,
				"can_viewer_save": true,
				"organic_tracking_token": "eyJ2ZXJzaW9uIjo1LCJwYXlsb2FkIjp7ImlzX2FuYWx5dGljc190cmFjaxxxx",
				"expiring_at": 1533909020,
				"can_reshare": true,
				"story_events": [],
				"story_hashtags": [],
				"story_polls": [],
				"story_feed_media": [],
				"story_sound_on": [],
				"creative_config": null,
				"reel_mentions": [],
				"story_locations": [],
				"story_sliders": [],
				"story_questions": [],
				"story_friend_lists": [],
				"story_music_stickers": [],
				"story_highlight": [],
				"story_product_items": [],
				"supports_reel_reactions": false,
				"show_one_tap_fb_share_tooltip": true,
				"has_shared_to_fb": 0
			},
			...
		],
		"prefetch_count": 0,
		"has_besties_media": false,
		"status": "ok"
	}
}
```

You can use the [editor on GitHub](https://github.com/plonknimbuzz/sosmed-api/edit/master/README.md) to maintain and preview the content for your website in Markdown files.

Whenever you commit to this repository, GitHub Pages will run [Jekyll](https://jekyllrb.com/) to rebuild the pages in your site, from the content in your Markdown files.

### Markdown

Markdown is a lightweight and easy-to-use syntax for styling your writing. It includes conventions for

```markdown
Syntax highlighted code block

# Header 1
## Header 2
### Header 3

- Bulleted
- List

1. Numbered
2. List

**Bold** and _Italic_ and `Code` text

[Link](url) and ![Image](src)
```

For more details see [GitHub Flavored Markdown](https://guides.github.com/features/mastering-markdown/).

### Jekyll Themes

Your Pages site will use the layout and styles from the Jekyll theme you have selected in your [repository settings](https://github.com/plonknimbuzz/sosmed-api/settings). The name of this theme is saved in the Jekyll `_config.yml` configuration file.

### Support or Contact

Having trouble with Pages? Check out our [documentation](https://help.github.com/categories/github-pages-basics/) or [contact support](https://github.com/contact) and we’ll help you sort it out.
