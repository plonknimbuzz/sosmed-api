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
Untuk mendapatkan info dari user berdasarkan userid ataupun username (salah satunya saja). Jika userId tersedia, maka akan dipilih userId.

| Param | Type | Keterangan |
| --- | --- | --- |
| userId | Big int | **required** valid instagram userid |
| userName | string | **required** valid instagram username |





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
