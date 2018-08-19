# Sosmed API
[online documentation](https://plonknimbuzz.github.io/sosmed-api/)

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
$resultIg = $obj->api('ig', 'user_info', ['userId'=> '2289707047'])->output(); //json
echo $resultIg;
$resultTw = $obj->api('tw', 'search', ['keyword'=> 'php', 'otherParam'=> 'otherValue'])->output_array();//array
print_r($resultTw);
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

contoh:
```php
$obj->api('ig', 'user_info', ['userId'=> '2289707047'])->output();
$obj->api('ig', 'user_info', ['userName'=> 'jokowi'])->output();
```

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

contoh:
```php
$obj->api('ig', 'media_info', ['mediaId'=> '1848426293047533255_1763799687'])->output();
$obj->api('ig', 'media_info', ['mediaUrl'=> 'https://www.instagram.com/p/Bmm7euOlx7H'])->output();
```

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

contoh:
```php
$obj->api('ig', 'media_likers', ['mediaId'=> '1848426293047533255_1763799687'])->output();
$obj->api('ig', 'media_likers', ['mediaUrl'=> 'https://www.instagram.com/p/Bmm7euOlx7H'])->output();
```

```json
{
	"ok": 0,
	"data": {
		"smd_type": "instagram",
		"media_id": "1833762174105693829_31302xxxx",
		"media_url": "https://www.instagram.com/p/Bly1PtOxxx",
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
| maxId | string | *optional* for backward pagination (get older comment) |
| minId | string | *optional* for forward pagination (get newer comment) |

contoh:
```php
$obj->api('ig', 'media_comments', ['mediaId'=> '1848426293047533255_1763799687'])->output();
$obj->api('ig', 'media_comments', ['mediaUrl'=> 'https://www.instagram.com/p/Bmm7euOlx7H'])->output();
```

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

| Param | Type | Keterangan |
| --- | --- | --- |
| userId | big int | **required** valid instagram userid (*prefer*) |
| userName | string | **required** valid instagram username |

contoh:
```php
$obj->api('ig', 'user_story', ['userId'=> '2289707047'])->output();
$obj->api('ig', 'user_story', ['userName'=> 'jokowi'])->output();
```

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

#### Generate UUID
Untuk membuat instagram unique id yang digunakan untuk keperluan tertentu

contoh:
```php
$obj->api('ig', 'generate_uuid', [])->output();
```

```json
{
    "ok":1,
    "data":{
        "smd_type":"instagram",
        "uuid":"9a44b71d-3500-49a0-9e4e-ac82b28d98dc"
    }
}
```

#### Hashtag Media
Untuk list media dari suatu hashtag (valid hashtag)

| Param | Type | Keterangan |
| --- | --- | --- |
| hashtag | string | **required** hashtag keyword without \# |
| uuid | string | *optional* valid ig UUID |
| maxId | string | *optional* for pagination |

**NOTE:** gunakan uuid yang sama untuk proses pagination

contoh:
```php
$obj->api('ig', 'hashtag_media', ['hashtag'=> 'jokowi'])->output();
```

```json
{
    "ok":0,
    "data":{
        "smd_type":"instagram",
        "hashtag_media":[ 
			//media info array
		]
	}
}

```

#### Hashtag Info
Untuk mendapatkan informasi mengenai suatu hashtag (valid hashtag)

| Param | Type | Keterangan |
| --- | --- | --- |
| hashtag | string | **required** valid instagram hashtag without \# |

contoh:
```php
$obj->api('ig', 'hashtag_info', ['hashtag'=> 'jokowi'])->output();
```

```json
{
    "ok":1,
    "data":{
        "smd_type":"instagram",
        "hashtag_id":"17842287xxxxx",
        "name":"jokxxx",
        "media_count":8xxx,
        "allow_following":1,
        "allow_muting_story":true,
        "non_violating":1
    }
}
```

#### Hashtag Search
Untuk mencari list hashtag dari suatu keyword

| Param | Type | Keterangan |
| --- | --- | --- |
| hashtag | string | **required** hashtag keyword without \# |
| exclude | array | *optional* valid list hashtag id in array |
| rankToken | string | *optional* for pagination |

contoh:
```php
$obj->api('ig', 'hashtag_search', ['hashtag'=> 'jokowi'])->output();
```

```json
{
    "ok":1,
    "data":{
        "smd_type":"instagram",
        "hashtag_search":{
            "results":[
                {
                    "hashtag_id":"17842287427071865",
                    "name":"jokowi",
                    "media_count":856708,
                    "allow_following":null,
                    "allow_muting_story":null,
                    "non_violating":null
                },
				//...
            ],
            "has_more":true,
            "rank_token":"86c1bbc0-fa9b-4498-b8b9-5d8b3da0ea76",
            "status":"ok"
        }
    }
}
```

#### Location Search

Untuk mencari list lokasi berdasarkan posisi garis bujur dan keyword

| Param | Type | Keterangan |
| --- | --- | --- |
| lat | string | **required** latitude |
| lng | string | **required** longitude |
| keyword | string | *optional* If provided, Instagram does a worldwide location text search, but lists locations closest to your lat/lng first. |

contoh:
```php
$obj->api('ig', 'location_search', ['lat'=> '6.1697222222222', 'lng'=>'106.83083333333'])->output();
$obj->api('ig', 'location_search', ['lat'=> '6.1697222222222', 'lng'=>'106.83083333333', 'keyword'=>'masjid'])->output();
```

**Note:** harusnya contoh ke-2 menghasilkan list masjid di sekitar monas (jakarta), akan tetapi malah menghasilkan list masjid di seluruh indonesia, ex: masjid banda aceh, masjid al-akbar surabaya. Hal ini dikarenakan tidak semua lokasi pernah didaftarkan di IG, berbeda dengan gmap yang melakukan pencatatan secara aktif.

```json
{
    "ok":0,
    "data":{
        "smd_type":"instagram",
        "ok":1,
        "location_media":[
            {
                "lat":-6.1701595929695,
                "lng":106.8401373358,
                "address":"Jakarta",
                "external_id":"154609294718013",
                "external_id_source":"facebook_places",
                "name":"Tugu Monumen Republik Indonesia Monas Jakarta Pusat",
                "minimum_age":0
            },
			//...
		]
	}
}

```

#### Location FB Search

Untuk mencari list lokasi Facebook berdasarkan keyword. Posisi yang ditemukan tidak dapat digunakan untuk di attach pada IG, hasil ini bisa digunakan untuk location search

| Param | Type | Keterangan |
| --- | --- | --- |
| keyword | string | *required* search keyword. |
| exclude | array | *optional* valid list fb location id in array |
| rankToken | string | *optional* for pagination |

contoh:
```php
$obj->api('ig', 'location_fb_search', ['keyword'=>'monas'])->output();
```

```json
{
    "ok":1,
    "data":{
        "smd_type":"instagram",
        "location_fb_search":{
            "items":[
                {
                    "location":{
                        "pk":"1022293376",
                        "name":"Monas",
                        "address":"Jalan Medan Merdeka",
                        "city":"Jakarta, Indonesia",
                        "short_name":"Monas",
                        "lng":106.82596866742,
                        "lat":-6.1767270457065,
                        "external_source":"facebook_places",
                        "facebook_places_id":"739273872776036"
                    },
                    "title":"Monas",
                    "subtitle":"Jalan Medan Merdeka, Jakarta, Indonesia",
                    "media_bundles":[

                    ]
                },
                //...
            ],
            "has_more":true,
            "rank_token":"53524478-400f-49a6-84ca-f4d9cb54d213",
            "status":"ok"
        }
    }
}```

#### Location FB Nearby

Untuk mencari list lokasi Facebook terdekat berdasarkan posisi garis bujur dan keyword. Posisi yang ditemukan tidak dapat digunakan untuk di attach pada IG, hasil ini bisa digunakan untuk location search

| Param | Type | Keterangan |
| --- | --- | --- |
| lat | string | **required** latitude |
| lng | string | **required** longitude |
| keyword | string | *optional* If provided, Instagram does a worldwide location text search, but lists locations closest to your lat/lng first. |
| exclude | array | *optional* valid list fb location id in array |
| rankToken | string | *optional* for pagination |


contoh:
```php
$obj->api('ig', 'location_fb_nearby', ['lat'=> '6.1697222222222', 'lng'=>'106.83083333333'])->output();
```


```json
{
    "ok":1,
    "data":{
        "smd_type":"instagram",
        "location_media":{
            "items":[
                {
                    "location":{
                        "pk":"250557511",
                        "name":"Djakarta Cafe",
                        "address":"Gedung Djakarta Theater Lt Ground Lobby Area",
                        "city":"Jakarta, Indonesia",
                        "short_name":"Djakarta Cafe",
                        "lng":106.86953,
                        "lat":-6.14371,
                        "external_source":"facebook_places",
                        "facebook_places_id":"631359280274702"
                    },
                    "title":"Djakarta Cafe",
                    "subtitle":"Gedung Djakarta Theater Lt Ground Lobby Area, Jakarta, Indonesia",
                    "media_bundles":[

                    ]
                },
				//...
            ],
            "has_more":true,
            "rank_token":"56cc463c-24ff-49a9-8542-26ecf33e08b3",
            "status":"ok"
        }
    }
}
```

#### Location Media

Untuk mencari list media dari suatu lokasi 

| Param | Type | Keterangan |
| --- | --- | --- |
| location_id | Big Int | *required* valid instagram location id. |

contoh:
```php
$obj->api('ig', 'location_media', ['location_id'=>'147276218683873'])->output();
```

```json
{
	"ok":1,
    "data":{
        "smd_type":"instagram",
        "location_media":[
			//media info array
		]
	}
}
```

### Twitter

#### User Info

Untuk mencari info mengenai user 

| Param | Type | Keterangan |
| --- | --- | --- |
| userId | big int | **required** valid twitter userid (*prefer*) |
| userName | string | **required** valid twitter username |

contoh:
```php
$obj->api('tw', 'user_info', ['userName'=> 'jokowi'])->output();
```

```json
{
    "ok":1,
    "data":{
        "smd_type":"twitter",
        "user_info":{
            "id":1146609174,
            "id_str":"1146609174",
            "name":"Eko Satrio P",
            "screen_name":"plonknimbuzz",
            "location":"jakarta",
            "profile_location":null,
            "description":"just ordinary guy",
            "url":"https:\/\/t.co\/jirDefsoVk",
            "entities":{
                "url":{
                    "urls":[
                        {
                            "url":"https:\/\/t.co\/jirDefsoVk",
                            "expanded_url":"http:\/\/simonita.org",
                            "display_url":"simonita.org",
                            "indices":[
                                0,
                                23
                            ]
                        }
                    ]
                },
                "description":{
                    "urls":[

                    ]
                }
            },
            "protected":false,
            "followers_count":20,
            "friends_count":5,
            "listed_count":0,
            "created_at":"Mon Feb 04 00:31:53 +0000 2013",
            "favourites_count":11,
            "utc_offset":null,
            "time_zone":null,
            "geo_enabled":false,
            "verified":false,
            "statuses_count":63,
            "lang":"en",
            "status":{
                "created_at":"Sat Jul 07 19:37:54 +0000 2018",
                "id":"1015681333358522368",
                "id_str":"1015681333358522368",
                "text":"RT @plonknimbuzz: nanana",
                "truncated":false,
                "entities":{
                    "hashtags":[

                    ],
                    "symbols":[

                    ],
                    "user_mentions":[
                        {
                            "screen_name":"plonknimbuzz",
                            "name":"Eko Satrio P",
                            "id":1146609174,
                            "id_str":"1146609174",
                            "indices":[
                                3,
                                16
                            ]
                        }
                    ],
                    "urls":[

                    ]
                },
                "source":"<a href=\"http:\/\/example.com\" rel=\"nofollow\">auto-twitter-plonk<\/a>",
                "in_reply_to_status_id":null,
                "in_reply_to_status_id_str":null,
                "in_reply_to_user_id":null,
                "in_reply_to_user_id_str":null,
                "in_reply_to_screen_name":null,
                "geo":null,
                "coordinates":null,
                "place":null,
                "contributors":null,
                "retweeted_status":{
                    "created_at":"Sat Jul 07 10:01:52 +0000 2018",
                    "id":"1015536367785336832",
                    "id_str":"1015536367785336832",
                    "text":"nanana",
                    "truncated":false,
                    "entities":{
                        "hashtags":[

                        ],
                        "symbols":[

                        ],
                        "user_mentions":[

                        ],
                        "urls":[

                        ]
                    },
                    "source":"<a href=\"http:\/\/twitter.com\" rel=\"nofollow\">Twitter Web Client<\/a>",
                    "in_reply_to_status_id":null,
                    "in_reply_to_status_id_str":null,
                    "in_reply_to_user_id":null,
                    "in_reply_to_user_id_str":null,
                    "in_reply_to_screen_name":null,
                    "geo":null,
                    "coordinates":null,
                    "place":null,
                    "contributors":null,
                    "is_quote_status":false,
                    "retweet_count":2,
                    "favorite_count":2,
                    "favorited":true,
                    "retweeted":true,
                    "lang":"in"
                },
                "is_quote_status":false,
                "retweet_count":2,
                "favorite_count":0,
                "favorited":true,
                "retweeted":true,
                "lang":"in"
            },
            "contributors_enabled":false,
            "is_translator":false,
            "is_translation_enabled":false,
            "profile_background_color":"C0DEED",
            "profile_background_image_url":"http:\/\/abs.twimg.com\/images\/themes\/theme1\/bg.png",
            "profile_background_image_url_https":"https:\/\/abs.twimg.com\/images\/themes\/theme1\/bg.png",
            "profile_background_tile":false,
            "profile_image_url":"http:\/\/abs.twimg.com\/sticky\/default_profile_images\/default_profile_normal.png",
            "profile_image_url_https":"https:\/\/abs.twimg.com\/sticky\/default_profile_images\/default_profile_normal.png",
            "profile_link_color":"1DA1F2",
            "profile_sidebar_border_color":"C0DEED",
            "profile_sidebar_fill_color":"DDEEF6",
            "profile_text_color":"333333",
            "profile_use_background_image":true,
            "has_extended_profile":false,
            "default_profile":true,
            "default_profile_image":true,
            "following":false,
            "follow_request_sent":false,
            "notifications":false,
            "translator_type":"none"
        }
    }
}
```

#### Search Tweet

Mencari tweet berdasarkan keyword

| Param | Type | Keterangan |
| --- | --- | --- |
| keyword | string | **required** keyword |
| geocode | string | *optional* geocode location and radius (mi/km). maximum radius is 1000 unit ex: *6.1697222222222, 106.83083333333, 2km* |
| lang | string | *optional* Restricts tweets to the given language, given by an [ISO 639-1](http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) code |
| result_type | string | *optional* * recent : return only the most recent results in the response. * popular : return only the most popular results in the response. default *mixed* both recent and popular. |
| count | int | *optional* number tweets per page. default: 15, max: 100 |
| until | date |  *optional* Returns tweets created before the given date. Format Y-m-d, max 7 day |
| since_id | big int |  *optional* Returns results with an ID greater than (that is, more recent than) the specified ID. If the limit of Tweets has occured since the since_id, the since_id will be forced to the oldest ID available. |
| max_id | big int |  *optional* Returns results with an ID less than (that is, older than) or equal to the specified ID. |
| include_entities | boolean|  *optional* The entities node will not be included when set to false. |

contoh:
```php
$obj->api('tw', 'search_tweet', ['keyword'=> 'jokowi'])->output();
```

```json
{
    "ok":1,
    "data":{
        "smd_type":"twitter",
        "search_tweet":{
            "statuses":[
                {
                    "created_at":"Fri Aug 17 06:19:14 +0000 2018",
                    "id":"1030338241822507008",
                    "id_str":"1030338241822507008",
                    "text":"RT @Join_Jabar: 2019 Tetap Join\n#JokowiMarufAminJOIN \nBaarakallah\n@jokowi\n@cakimiNOW\n@arjuna16sp @pkbSULTRA @DPP_PKB @JOIN_BANTEN @joinjomb\u2026",
                    "truncated":false,
                    "entities":{
                        "hashtags":[
                            {
                                "text":"JokowiMarufAminJOIN",
                                "indices":[
                                    32,
                                    52
                                ]
                            }
                        ],
                        "symbols":[

                        ],
                        "user_mentions":[
                            {
                                "screen_name":"Join_Jabar",
                                "name":"JOIN JABAR",
                                "id":"856053640095703040",
                                "id_str":"856053640095703040",
                                "indices":[
                                    3,
                                    14
                                ]
                            },
                            {
                                "screen_name":"jokowi",
                                "name":"Joko Widodo",
                                "id":366987179,
                                "id_str":"366987179",
                                "indices":[
                                    66,
                                    73
                                ]
                            },
                            {
                                "screen_name":"cakimiNOW",
                                "name":"a muhaimin iskandar",
                                "id":1490116879,
                                "id_str":"1490116879",
                                "indices":[
                                    74,
                                    84
                                ]
                            },
                            {
                                "screen_name":"arjuna16sp",
                                "name":"Arjuna SP (Cak JUN)",
                                "id":"889910471561793541",
                                "id_str":"889910471561793541",
                                "indices":[
                                    85,
                                    96
                                ]
                            },
                            {
                                "screen_name":"pkbSULTRA",
                                "name":"DPW PKB SULTRA",
                                "id":"1005835075437514752",
                                "id_str":"1005835075437514752",
                                "indices":[
                                    97,
                                    107
                                ]
                            },
                            {
                                "screen_name":"DPP_PKB",
                                "name":"DPP PKB",
                                "id":748953283,
                                "id_str":"748953283",
                                "indices":[
                                    108,
                                    116
                                ]
                            },
                            {
                                "screen_name":"JOIN_BANTEN",
                                "name":"JOIN BANTEN (Jokowi_Ma'ruf Amin)",
                                "id":"951393858708914177",
                                "id_str":"951393858708914177",
                                "indices":[
                                    117,
                                    129
                                ]
                            }
                        ],
                        "urls":[

                        ]
                    },
                    "metadata":{
                        "iso_language_code":"in",
                        "result_type":"recent"
                    },
                    "source":"<a href=\"http:\/\/twitter.com\" rel=\"nofollow\">Twitter Web Client<\/a>",
                    "in_reply_to_status_id":null,
                    "in_reply_to_status_id_str":null,
                    "in_reply_to_user_id":null,
                    "in_reply_to_user_id_str":null,
                    "in_reply_to_screen_name":null,
                    "user":{
                        "id":"985058014972358656",
                        "id_str":"985058014972358656",
                        "name":"JOIN PSiantar",
                        "screen_name":"JoinPSiantar",
                        "location":"Pematang Siantar, Indonesia",
                        "description":"#JokowiCakImin2019",
                        "url":null,
                        "entities":{
                            "description":{
                                "urls":[

                                ]
                            }
                        },
                        "protected":false,
                        "followers_count":400,
                        "friends_count":683,
                        "listed_count":0,
                        "created_at":"Sat Apr 14 07:31:47 +0000 2018",
                        "favourites_count":1359,
                        "utc_offset":null,
                        "time_zone":null,
                        "geo_enabled":true,
                        "verified":false,
                        "statuses_count":1571,
                        "lang":"id",
                        "contributors_enabled":false,
                        "is_translator":false,
                        "is_translation_enabled":false,
                        "profile_background_color":"F5F8FA",
                        "profile_background_image_url":null,
                        "profile_background_image_url_https":null,
                        "profile_background_tile":false,
                        "profile_image_url":"http:\/\/pbs.twimg.com\/profile_images\/1027930828234358786\/agXbFPHv_normal.jpg",
                        "profile_image_url_https":"https:\/\/pbs.twimg.com\/profile_images\/1027930828234358786\/agXbFPHv_normal.jpg",
                        "profile_banner_url":"https:\/\/pbs.twimg.com\/profile_banners\/985058014972358656\/1533912670",
                        "profile_link_color":"1DA1F2",
                        "profile_sidebar_border_color":"C0DEED",
                        "profile_sidebar_fill_color":"DDEEF6",
                        "profile_text_color":"333333",
                        "profile_use_background_image":true,
                        "has_extended_profile":true,
                        "default_profile":true,
                        "default_profile_image":false,
                        "following":false,
                        "follow_request_sent":false,
                        "notifications":false,
                        "translator_type":"none"
                    },
                    "geo":null,
                    "coordinates":null,
                    "place":null,
                    "contributors":null,
                    "retweeted_status":{
                        "created_at":"Sat Aug 11 02:00:23 +0000 2018",
                        "id":"1028098774155980800",
                        "id_str":"1028098774155980800",
                        "text":"2019 Tetap Join\n#JokowiMarufAminJOIN \nBaarakallah\n@jokowi\n@cakimiNOW\n@arjuna16sp @pkbSULTRA @DPP_PKB @JOIN_BANTEN\u2026 https:\/\/t.co\/hygl2tv96t",
                        "truncated":true,
                        "entities":{
                            "hashtags":[
                                {
                                    "text":"JokowiMarufAminJOIN",
                                    "indices":[
                                        16,
                                        36
                                    ]
                                }
                            ],
                            "symbols":[

                            ],
                            "user_mentions":[
                                {
                                    "screen_name":"jokowi",
                                    "name":"Joko Widodo",
                                    "id":366987179,
                                    "id_str":"366987179",
                                    "indices":[
                                        50,
                                        57
                                    ]
                                },
                                {
                                    "screen_name":"cakimiNOW",
                                    "name":"a muhaimin iskandar",
                                    "id":1490116879,
                                    "id_str":"1490116879",
                                    "indices":[
                                        58,
                                        68
                                    ]
                                },
                                {
                                    "screen_name":"arjuna16sp",
                                    "name":"Arjuna SP (Cak JUN)",
                                    "id":"889910471561793541",
                                    "id_str":"889910471561793541",
                                    "indices":[
                                        69,
                                        80
                                    ]
                                },
                                {
                                    "screen_name":"pkbSULTRA",
                                    "name":"DPW PKB SULTRA",
                                    "id":"1005835075437514752",
                                    "id_str":"1005835075437514752",
                                    "indices":[
                                        81,
                                        91
                                    ]
                                },
                                {
                                    "screen_name":"DPP_PKB",
                                    "name":"DPP PKB",
                                    "id":748953283,
                                    "id_str":"748953283",
                                    "indices":[
                                        92,
                                        100
                                    ]
                                },
                                {
                                    "screen_name":"JOIN_BANTEN",
                                    "name":"JOIN BANTEN (Jokowi_Ma'ruf Amin)",
                                    "id":"951393858708914177",
                                    "id_str":"951393858708914177",
                                    "indices":[
                                        101,
                                        113
                                    ]
                                }
                            ],
                            "urls":[
                                {
                                    "url":"https:\/\/t.co\/hygl2tv96t",
                                    "expanded_url":"https:\/\/twitter.com\/i\/web\/status\/1028098774155980800",
                                    "display_url":"twitter.com\/i\/web\/status\/1\u2026",
                                    "indices":[
                                        115,
                                        138
                                    ]
                                }
                            ]
                        },
                        "metadata":{
                            "iso_language_code":"in",
                            "result_type":"recent"
                        },
                        "source":"<a href=\"http:\/\/twitter.com\/download\/android\" rel=\"nofollow\">Twitter for Android<\/a>",
                        "in_reply_to_status_id":null,
                        "in_reply_to_status_id_str":null,
                        "in_reply_to_user_id":null,
                        "in_reply_to_user_id_str":null,
                        "in_reply_to_screen_name":null,
                        "user":{
                            "id":"856053640095703040",
                            "id_str":"856053640095703040",
                            "name":"JOIN JABAR",
                            "screen_name":"Join_Jabar",
                            "location":"Jawa Barat, Indonesia",
                            "description":"Jokowi - Ma'ruf Amin 2019",
                            "url":null,
                            "entities":{
                                "description":{
                                    "urls":[

                                    ]
                                }
                            },
                            "protected":false,
                            "followers_count":1414,
                            "friends_count":735,
                            "listed_count":0,
                            "created_at":"Sun Apr 23 07:54:27 +0000 2017",
                            "favourites_count":3044,
                            "utc_offset":null,
                            "time_zone":null,
                            "geo_enabled":false,
                            "verified":false,
                            "statuses_count":3475,
                            "lang":"id",
                            "contributors_enabled":false,
                            "is_translator":false,
                            "is_translation_enabled":false,
                            "profile_background_color":"F5F8FA",
                            "profile_background_image_url":null,
                            "profile_background_image_url_https":null,
                            "profile_background_tile":false,
                            "profile_image_url":"http:\/\/pbs.twimg.com\/profile_images\/1027906168893534209\/r6O4yMyz_normal.jpg",
                            "profile_image_url_https":"https:\/\/pbs.twimg.com\/profile_images\/1027906168893534209\/r6O4yMyz_normal.jpg",
                            "profile_banner_url":"https:\/\/pbs.twimg.com\/profile_banners\/856053640095703040\/1531653599",
                            "profile_link_color":"1DA1F2",
                            "profile_sidebar_border_color":"C0DEED",
                            "profile_sidebar_fill_color":"DDEEF6",
                            "profile_text_color":"333333",
                            "profile_use_background_image":true,
                            "has_extended_profile":false,
                            "default_profile":true,
                            "default_profile_image":false,
                            "following":false,
                            "follow_request_sent":false,
                            "notifications":false,
                            "translator_type":"none"
                        },
                        "geo":null,
                        "coordinates":null,
                        "place":null,
                        "contributors":null,
                        "is_quote_status":false,
                        "retweet_count":8,
                        "favorite_count":14,
                        "favorited":false,
                        "retweeted":false,
                        "possibly_sensitive":false,
                        "lang":"in"
                    },
                    "is_quote_status":false,
                    "retweet_count":8,
                    "favorite_count":0,
                    "favorited":false,
                    "retweeted":false,
                    "lang":"in"
                },
                //...
            ],
            "search_metadata":{
                "completed_in":0.046,
                "max_id":"1030338241822507008",
                "max_id_str":"1030338241822507008",
                "next_results":"?max_id=1030338236701335552&q=jokowi&count=2&include_entities=1&result_type=recent",
                "query":"jokowi",
                "refresh_url":"?since_id=1030338241822507008&q=jokowi&result_type=recent&include_entities=1",
                "count":2,
                "since_id":0,
                "since_id_str":"0"
            }
        }
    }
}
```

#### Search Location

Mencari lokasi suatu tempat pada twitter

| Param | Type | Keterangan |
| --- | --- | --- |
| keyword | string | *optional* location keyword |
| lat | string | *optional* latitude |
| lng | string | *optional* longitude |

**Note:** Required minimal 1 diantaranya.

contoh:
```php
$obj->api('tw', 'search_location', ['keyword'=> 'monas'])->output();
```

```json
{
    "ok":1,
    "data":{
        "smd_type":"twitter",
        "search_location":{
            "result":{
                "places":[
                    {
                        "id":"beddf2d6061ea32e",
                        "url":"https:\/\/api.twitter.com\/1.1\/geo\/id\/beddf2d6061ea32e.json",
                        "place_type":"admin",
                        "name":"DKI Jakarta",
                        "full_name":"DKI Jakarta, Indonesia",
                        "country_code":"ID",
                        "country":"Indonesia",
                        "contained_within":[
                            {
                                "id":"ce7988d3a8b6f49f",
                                "url":"https:\/\/api.twitter.com\/1.1\/geo\/id\/ce7988d3a8b6f49f.json",
                                "place_type":"country",
                                "name":"Indonesia",
                                "full_name":"Indonesia",
                                "country_code":"ID",
                                "country":"Indonesia",
                                "centroid":[
                                    113.33412818144045,
                                    0.11379699999999993
                                ],
                                "bounding_box":{
                                    "type":"Polygon",
                                    "coordinates":[
                                        [
                                            [
                                                95.004677,
                                                -11.007615
                                            ],
                                            [
                                                95.004677,
                                                5.906884
                                            ],
                                            [
                                                141.0549412,
                                                5.906884
                                            ],
                                            [
                                                141.0549412,
                                                -11.007615
                                            ],
                                            [
                                                95.004677,
                                                -11.007615
                                            ]
                                        ]
                                    ]
                                },
                                "attributes":[

                                ]
                            }
                        ],
                        "centroid":[
                            106.84823565767005,
                            -6.23296
                        ],
                        "bounding_box":{
                            "type":"Polygon",
                            "coordinates":[
                                [
                                    [
                                        106.6884,
                                        -6.37657
                                    ],
                                    [
                                        106.6884,
                                        -6.08935
                                    ],
                                    [
                                        106.980499,
                                        -6.08935
                                    ],
                                    [
                                        106.980499,
                                        -6.37657
                                    ],
                                    [
                                        106.6884,
                                        -6.37657
                                    ]
                                ]
                            ]
                        },
                        "attributes":[

                        ]
                    },
                    //...
                ]
            },
            "query":{
                "url":"https:\/\/api.twitter.com\/1.1\/geo\/search.json?lat=&long=&query=jakarta",
                "type":"search",
                "params":{
                    "accuracy":0,
                    "granularity":"neighborhood",
                    "query":"jakarta",
                    "autocomplete":false,
                    "trim_place":false
                }
            }
        }
    }
}
```


### Youtube

#### Video Info

Mencari info terhadap suatu video

| Param | Type | Keterangan |
| --- | --- | --- |
| videoId | string | **required** valid youtube video Id |

contoh:
```php
$obj->api('yt', 'video_info', ['videoId'=> 'QMG8BQCHtzs'])->output();
```

```json
{
    "ok":1,
    "data":{
        "smd_type":"youtube",
        "video_info":{
            "etag":"\"XI7nbFXulYBIpL0ayR_gDh3eu1k\/-O6k3CEnq-DTEAZHVXZ1MziLbW8\"",
            "eventId":null,
            "kind":"youtube#videoListResponse",
            "nextPageToken":null,
            "prevPageToken":null,
            "visitorId":null,
            "pageInfo":{
                "resultsPerPage":1,
                "totalResults":1
            },
            "items":[
                {
                    "etag":"\"XI7nbFXulYBIpL0ayR_gDh3eu1k\/AMM-c7x-fgO4SlET_nAUGruxENM\"",
                    "id":"1ERsRZVRteI",
                    "kind":"youtube#video",
                    "snippet":{
                        "categoryId":"20",
                        "channelId":"UC1MiVrMfNrs5Ma4BetX-asA",
                        "channelTitle":"JustWant2PlayAGame",
                        "defaultAudioLanguage":null,
                        "defaultLanguage":null,
                        "description":"\ud83d\udc99Win Skins Now: https:\/\/gamdom.com\/tradeup\n\ud83d\udd34Subscribe for More Videos: http:\/\/goo.gl\/SS787Y\n\u25baMIRACLE- Invoker TI8 Perspective - What a Crazy Game (Liquid vs OG)\n\n\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\n\u25cf Submit your best Replay , Pls email:  justwanplayagame@gmail.com\n\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\n\u25cfSocial Media:\n\u25cf Facebook: https:\/\/www.facebook.com\/Justwanplayagame\/\n\u25cf Twitter: https:\/\/twitter.com\/justwanplayagam\n\u25cf VK: http:\/\/vk.com\/justwanplayagame\n\u25cf Google+: https:\/\/plus.google.com\/+JustWanPlayAGameBro\n\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\n\n\ud83d\udd25My Dota 2 Playlists:\n\u25cf Miracle, Always Miracle: https:\/\/goo.gl\/Io5frD\n\u25cf Mushi, Be Like Mushi: https:\/\/goo.gl\/4SvCee\n\u25cf Midone, The Solo Mid One: https:\/\/goo.gl\/n29HVg\n\u25cf The International 2016 Highlights: https:\/\/goo.gl\/SJfzuR\n\u25cf !Attacker, The Best Kunkka: https:\/\/goo.gl\/GxY6Wc\n\u25cf Sumail, the Best Storm Spirit: https:\/\/goo.gl\/hYiG9D\n\u25cf Dendi, The Living Legend: https:\/\/goo.gl\/ejukAh\n\u25cf Arteezy, Positive Mental Attitude: https:\/\/goo.gl\/BRjquU\n\u25cf w33, The Imba w33haa: https:\/\/goo.gl\/Mwc7Pb\n\u25cf s4, The Son of Magnus: https:\/\/goo.gl\/NcY5It\n\u25cf Ar1se, The Best Magnus: https:\/\/goo.gl\/sYvMy7\n\u25cf Manila Major Epic Game: https:\/\/goo.gl\/xLIQ5q\n\u25cf Dota 2 Random Proplay-: https:\/\/goo.gl\/x2ynVV\n\u25cf TOP10\/Best Moments of Tournament: https:\/\/goo.gl\/5NJUH8\n\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\nWelcome to my JustWant2PlayAGame Dota 2  channel\nHere the find highlights from random pub match, random pro match, major tournaments and many other interesting dota movies. \nRemember to SUBSCRIBE to be notified when we publish new videos or highlights!\n\nDota 2 Team: OG, Wings, Secret, Fnatic, Liquid, LGD, IG, Newbee, EG, Navi, Empire, COL, Xctn, VGR, VG, VP, Ehome, TNC, Escape Gaming, Alliance, Mineski, LFY etc\n\nEnjoy and Make sure to subscribe to my channel if you liked the video!\n\nMatch id:\n4061952570",
                        "liveBroadcastContent":"none",
                        "publishedAt":"2018-08-17T08:18:31.000Z",
                        "tags":[
                            "Justwant2playagame",
                            "dota 2",
                            "dota",
                            "miracle-",
                            "highlights",
                            "gameplay",
                            "justwanplayagame",
                            "9k",
                            "9kmmr",
                            "m-god"
                        ],
                        "title":"MIRACLE- Invoker TI8 Perspective - What a Crazy Game (Liquid vs OG)",
                        "thumbnails":{
                            "default":{
                                "height":90,
                                "url":"https:\/\/i.ytimg.com\/vi\/1ERsRZVRteI\/default.jpg",
                                "width":120
                            },
                            "medium":{
                                "height":180,
                                "url":"https:\/\/i.ytimg.com\/vi\/1ERsRZVRteI\/mqdefault.jpg",
                                "width":320
                            },
                            "high":{
                                "height":360,
                                "url":"https:\/\/i.ytimg.com\/vi\/1ERsRZVRteI\/hqdefault.jpg",
                                "width":480
                            },
                            "standard":{
                                "height":480,
                                "url":"https:\/\/i.ytimg.com\/vi\/1ERsRZVRteI\/sddefault.jpg",
                                "width":640
                            },
                            "maxres":{
                                "height":720,
                                "url":"https:\/\/i.ytimg.com\/vi\/1ERsRZVRteI\/maxresdefault.jpg",
                                "width":1280
                            }
                        },
                        "localized":{
                            "description":"\ud83d\udc99Win Skins Now: https:\/\/gamdom.com\/tradeup\n\ud83d\udd34Subscribe for More Videos: http:\/\/goo.gl\/SS787Y\n\u25baMIRACLE- Invoker TI8 Perspective - What a Crazy Game (Liquid vs OG)\n\n\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\n\u25cf Submit your best Replay , Pls email:  justwanplayagame@gmail.com\n\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\n\u25cfSocial Media:\n\u25cf Facebook: https:\/\/www.facebook.com\/Justwanplayagame\/\n\u25cf Twitter: https:\/\/twitter.com\/justwanplayagam\n\u25cf VK: http:\/\/vk.com\/justwanplayagame\n\u25cf Google+: https:\/\/plus.google.com\/+JustWanPlayAGameBro\n\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\n\n\ud83d\udd25My Dota 2 Playlists:\n\u25cf Miracle, Always Miracle: https:\/\/goo.gl\/Io5frD\n\u25cf Mushi, Be Like Mushi: https:\/\/goo.gl\/4SvCee\n\u25cf Midone, The Solo Mid One: https:\/\/goo.gl\/n29HVg\n\u25cf The International 2016 Highlights: https:\/\/goo.gl\/SJfzuR\n\u25cf !Attacker, The Best Kunkka: https:\/\/goo.gl\/GxY6Wc\n\u25cf Sumail, the Best Storm Spirit: https:\/\/goo.gl\/hYiG9D\n\u25cf Dendi, The Living Legend: https:\/\/goo.gl\/ejukAh\n\u25cf Arteezy, Positive Mental Attitude: https:\/\/goo.gl\/BRjquU\n\u25cf w33, The Imba w33haa: https:\/\/goo.gl\/Mwc7Pb\n\u25cf s4, The Son of Magnus: https:\/\/goo.gl\/NcY5It\n\u25cf Ar1se, The Best Magnus: https:\/\/goo.gl\/sYvMy7\n\u25cf Manila Major Epic Game: https:\/\/goo.gl\/xLIQ5q\n\u25cf Dota 2 Random Proplay-: https:\/\/goo.gl\/x2ynVV\n\u25cf TOP10\/Best Moments of Tournament: https:\/\/goo.gl\/5NJUH8\n\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\u25ac\nWelcome to my JustWant2PlayAGame Dota 2  channel\nHere the find highlights from random pub match, random pro match, major tournaments and many other interesting dota movies. \nRemember to SUBSCRIBE to be notified when we publish new videos or highlights!\n\nDota 2 Team: OG, Wings, Secret, Fnatic, Liquid, LGD, IG, Newbee, EG, Navi, Empire, COL, Xctn, VGR, VG, VP, Ehome, TNC, Escape Gaming, Alliance, Mineski, LFY etc\n\nEnjoy and Make sure to subscribe to my channel if you liked the video!\n\nMatch id:\n4061952570",
                            "title":"MIRACLE- Invoker TI8 Perspective - What a Crazy Game (Liquid vs OG)"
                        }
                    }
                }
            ]
        }
    }
}
```

### Error Code

| Code | Keterangan |
| --- | --- |
| 699 | Forbidden IP Address |
| 700 | Error code not recognized |
| 701 | Web module not registered |
| 702 | Type not recognized |
| 703 | Missing required parameter |

### Changelog

- 2018-08-17 : init commit
- 2018-08-19: 
  - update readme
  - add all possible param (include pagination purpose)
  - add example
