# Study
## 참고 사이트
- https://laravel.kr/
- https://www.lesstif.com/pages/viewpage.action?pageId=24445742
- http://l5.appkr.kr/lessons/04-routing-basics.html

## Laravle Study(2018.05~)
- laravel 프로젝트 코드를 git으로 땡기면 vendor를 땡기기 위해 composer install 써야하고 laravle app_key 생성해야한다. 
- Model::create fillable guarded 설정 create로 row생성시 guarded 된(fillable에 포함되지 않는) column은 값이 설정되지 않는다. 
  is_admin 같은 속성을 배열에서 바로 설정되지 않도록 하기 위한 기능 (직정 modle 객체를 생성하여 지정할 필요가 있는 중요한 column에 사용)
- Accessors & Mutators column을 가공할 필요가 있을때 사용 (추출시 Accessor 삽입시 Mutator) 
- relation with 기능 : eager load
- Laravel 5 IDE Helper Generator composer require barryvdh/laravel-ide-helper
- Model casting 설정 $cast 지정 append와 accessor append에 accesor를 추가하면 collection toArray에서 보인다. 
- 쿼리빌더 
- validation : msg는 '.'으로 구분하여 설정 가능 특정 항목 검사시 해당 항목만 분명 하게 검사하도록 로직 구현 (아이디 검사 : if(member) x , if(member->mid) o) 
- validation rule : https://laravel.kr/docs/5.6/validation#available-validation-rules
- resource/lang/kr/validation.php : 기본 validation 설정(attrivutes에 설정된 항목은 변환되어 출력 되고 아니면 Calmel case를 영어 띄어쓰기로 치환하여 출력
### 2018.06.07
- composer du - 클래스맵 패키지 안의 새로운 클래스들 때문에 오토로더를 업데이트 할 필요가 있는 경우, install 또는 update를 통하지 않고 “dump-autoload” 사용 할 수 있습니다.
- alias @ app.php, validation attributes @ validation.php 
- $request->route()->getActionName() : return ex ) App\Http\Controllers\LoginController@logout
- middleware 선언 위치 kernel.php
### 2018.06.08
- mysql 내장 function 작성시 DB::raw 사용 ex) Category::where(DB::raw('LENGTH(category)'),3)->orderBy('sort')->get()
- 개발 순서 : rest 정의 부터 진행 (리스트는 DOMAIN/countries : indexCountries 단일 항목은 DOMAIN/country : showCountry)
- 개발 순서 : rest 정의 -> route 정의 -> model 정의 -> controller 
- uri에 인자가 들어갈 경우 controller에서는 해당 인자 validation부터 수행 (DOMAIN/cities/{category})
- sql 약속어는 모두 대문자 작성
### 2018.06.18
- collection을 잘못 인식하고 있던것이 collectino은 vetoer array 같은 자료형으로 받아 드려야하고 안에 들어가는 내용은 단순 item 어떤것도 올수 있음.. only 같은 메소드는 collection item에 먹히는 method이고 values 같은 아이템은 collection 자체에서 호출되는 method 
### 2018.06.22
- eager loading relation sql 보는 방법 
```
vendor\laravel\framework\src\Illuminate\Database\Eloquent\Builder.php:eagerLoadRelation 
eagerLoadRelation method를 살펴보면 $relation->toSql()을 debug watch에 넣어놓고 보면 addEagerConstraints 수행 후 where in이 추가되는 걸 볼수 있다. 
key를 배열로 뽑아내고 implode 해서 in 절에 넣어 해당 key 값만 relation model로 가져온다.
```
- calling controller from another controller is bad prcatice[stackoverflow Q&A](https://stackoverflow.com/questions/30365169/access-controller-method-from-another-controller-in-laravel-5)
- 서비스 컨테이너 [SERVICE_CONTAINER.md](https://github.com/in2020/laravel/blob/master/SERVICE_CONTAINER.md)
### 2018.06.27
- global로 설치한 패키지 update : composer global update 
- helper : array_get, optional, head
- app.php class aliases에 등록해서 쓸수 있는데... 느려진다는데... 
- Facade 등록
### 2018.06.28
- artisan make:model 옵션중 -m을 주면 해당 모델에 대한 migration 파일이 자동으로 생성된다
```
php artisan make:model Blog -m
```
- method return type 선언시 null도 허용하고자 하면 자료형 앞에 ?를 붙인다.
```
function method() : ?Collection
{
    ...
}
```
### 2018.06.29
- Eloquent collection diff with Support Collection
 - Eloquent collection : Support Collection을 상속해서 구현되어 있음[Collection api](https://laravel.com/api/5.6/Illuminate/Database/Eloquent/Collection.html)

### 2018.07.02 
- Colleciton을 보다보니 Collection method들이 Array 형태로 예를 들고 있다. 그럼 object가 item 요소로 있을때 동작이 정확하지 않을 수 있을까?  
  -> 당연 하겠지만 문제없고 php native array 관련 함수들이 item이 object라도 예상대로 동작하는것을 알수 있다.
```
object일때 동작되지 않을 것 같은 method 몇개를 선택하여 test
다음 method를 분석 해 보기로 한다. diff
diff : 결국 Model Class diff method 구현부를 보면 array_diff로 구현 되어 있다. 
array로 되어있는 변수가 각 item이 object라도 object에 할당된 값을 비교하여 값을 return 한다. 
```
- model을 chaining 시 Database\Elquent\Builder 클래스 반환.
- 쿼리빌더 chaining 시 Database\Query\Builder 클래스 반환.
- validation : present 
- Is it better to separate a big query into multiple smaller queries?
  - network latency 측면으로 문제가 될수는 있지만 가독성과 db 연산을 줄인다는 점에서 big query를 지향해야 할것 같다.(db cpu를 더 많이 쓴다는 가정 하에)
  - rest api 개념으로 봤을때 숙소 목록을 뿌려준다고 할때 도시 필터나 테마 필터가 URI에 포함되는게 맞을까 request parameters에 포함되는게 맞을까?
