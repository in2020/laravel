# Laravel 5.4 on aws



## Index
* Aws(ec2) 
* Apache2.4 php7.0 mysql5.6 
* Laravel5.4
* Goal
* Laravel study

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

## [Laravel study](https://github.com/in2020/laravel/blob/master/STUDY.md)
