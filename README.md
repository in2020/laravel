# Laravel 5.4 on aws



## Index
* Aws(ec2) 
* Apache2.4 php7.0 mysql5.6 
* Laravel5.4
* Laravel study
* Goal

## Aws(ec2)
* Aws site: https://aws.amazon.com/ko/
* EC2: https://ap-northeast-2.console.aws.amazon.com/ec2/v2/home?region=ap-northeast-2
* EC2 guide: http://docs.aws.amazon.com/ko_kr/AWSEC2/latest/UserGuide/EC2_GetStarted.html#ec2-launch-instance
* PuTTY guide on Windows: http://docs.aws.amazon.com/ko_kr/AWSEC2/latest/UserGuide/putty.html
* Edit security group to connect by my ip http://docs.aws.amazon.com/ko_kr/AWSEC2/latest/UserGuide/authorizing-access-to-an-instance.html
## Apache2.4 php7.0 mysql5.6 
* AWS Lamp guide: http://docs.aws.amazon.com/ko_kr/AWSEC2/latest/UserGuide/install-LAMP.html

## Laravel 5.4
* https://laravel.kr/docs/5.4/installation#server-requirements
* How To Install Composer and Laravel on EC2 Instance: https://www.youtube.com/watch?v=p_VwZTmyG5o
* 라라벨 구조 설명 및 노드 모듈 설치: https://www.youtube.com/watch?v=0EOQToeoWP0

## Laravel study
* https://www.lesstif.com/pages/viewpage.action?pageId=24445742
* http://l5.appkr.kr/lessons/04-routing-basics.html

## Goal
* MVC
  * M : Eloquent 
  * V : Blade
  * C : ..
  
* Pretty URLs
  * apache mod_rewrite
  * /etc/httpd/conf/httpd.conf 수정
    * Directory /var/www/html AllowOverride ALL #원래는 None인데 ALL로 수정하자 설정 후 아파치 재시작한다

* 2017.11.05
	* insert logic 
* 2017.11.06	
	* image file upload
* 2017.11.07	
	*  not free... https://innostudio.de/fileuploader/documentation/#examples
  *  chose free library http://plugins.krajee.com/file-input#top
	
	
	
	
	
	
# Laravle Study(2018.05~)
- laravel 프로젝트 코드를 git으로 땡기면 vendor를 땡기기 위해 composer install 써야하고 laravle app_key 생성해야한다. 
- Model::create fillable guarded 설정 create로 row생성시 guarded 된(fillable에 포함되지 않는) column은 값이 설정되지 않는다. 
  is_admin 같은 속성을 배열에서 바로 설정되지 않도록 하기 위한 기능 (직정 modle 객체를 생성하여 지정할 필요가 있는 중요한 column에 사용)
- Accessors & Mutators column을 가공할 필요가 있을때 사용 (추출시 Accessor 삽입시 Mutator) 
- relation with 기능 : eager load
- Laravel 5 IDE Helper Generator composer require barryvdh/laravel-ide-helper
- Model casting 설정 $cast 지정 append와 accessor append에 accesor를 추가하면 collection toArray에서 보인다. 
- 쿼리빌더 
- validation : msg는 '.'으로 구분하여 설정 가능 특정 항목 검사시 해당 항목만 분명 하게 검사하도록 로직 구현 (아이디 검사 : if(member) x , if(member->mid) o)
