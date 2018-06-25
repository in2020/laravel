# Service Container
## Service Container 역할
- [참고 사이트](https://www.laravel.co.kr/posts/258)
- 라라벨의 서비스 컨테이너는 클래스의 의존성을 관리하고 의존성을 주입하는 강력한 도구 입니다.  
[Document](https://laravel.kr/docs/5.6/container)
- 유닛 테스트가 가능한 형태로 구현을 한다는 것은 확장성이 좋고 커플링이 적다는 의미.
- 기존에 interface 구현과 Factory 형태로 사용했으나 Factory 구현시 기능이 추가 될때마다 factory를 수정하거나 새로 만들어야하고 factory와 커플링되는 문제 발생
```
interface ItemInterface
{
    public function register($itemName);
}

class Item1 implements ItemInterface{
  public function register($itemName){
      ....
  }
}

class ItemFactory{
    public function getItem1(){
        return new Item1();
    }
}

class ItemController
{
    private $item;
  
    public function __construct(ItemInterface $item)
    {
        $this->item = $item;
    }
  
    public function register($itemName)
    {        
        $this->item->register($itemName);
    }
}

class ItemClass
{
    public function registerItem1($itemName){
        $itemController = new ItemController(new ItemFactory()->getItem1());
        $itemController->register($itemName);
    }
}
```
- 위와 같은 문제해결을 위해 전역 factory에 obejct를 넣은 Container를 두고 Contianer가 객체를 생성하도록 하여 객체 생성시 필요한 Object를 주입하도록 함.
```
class Container(){
    protected $bindings = [];
    
    public function bind($$abstract, $concrete){
        $this->bindings[$abstract] = $concrete;
    }
    
    public function make($abstract, array $parameters = [])
    {
        $rtnObject = null;
        
        ... // 생성자에 필요한 Object 주입
        
        return $object;
    }
}
```
- 위와 같이 함으로써 기능 추가등 수정사항 발생시 Factory 생성 or 수정 이 필요 없고,  
container에 등록하고 클래스에서 사용될 객체를 생성자 인자로 받도록 처리하면 된다. 
이외 생성자 인자 변경등에 따른 객체생성등은 contianer가 처리하도록 한다.
- Illuminate\Routing\Route 클래스 getController 메소드를 보면 아래와 같은 부분이 있다. 컨테이너로 Controller 객체를 생성한다. 
```
class Route{
...
    public function getController()
    {
        if (! $this->controller) {
            $class = $this->parseControllerCallback()[0];

            $this->controller = $this->container->make(ltrim($class, '\\'));
        }

        return $this->controller;
    }
...
}
    
class Container{
...
    public function make($abstract, array $parameters = [])
    {
        return $this->resolve($abstract, $parameters);
    }
    
    ...
    
    protected function resolve($abstract, $parameters = [])
    {
        $abstract = $this->getAlias($abstract);

        $needsContextualBuild = ! empty($parameters) || ! is_null(
            $this->getContextualConcrete($abstract)
        );

        // If an instance of the type is currently being managed as a singleton we'll
        // just return an existing instance instead of instantiating new instances
        // so the developer can keep using the same objects instance every time.
        if (isset($this->instances[$abstract]) && ! $needsContextualBuild) {
            return $this->instances[$abstract];
        }

        $this->with[] = $parameters;

        $concrete = $this->getConcrete($abstract);

        // We're ready to instantiate an instance of the concrete type registered for
        // the binding. This will instantiate the types, as well as resolve any of
        // its "nested" dependencies recursively until all have gotten resolved.
        if ($this->isBuildable($concrete, $abstract)) {
            $object = $this->build($concrete);
        } else {
            $object = $this->make($concrete);
        }

        // If we defined any extenders for this type, we'll need to spin through them
        // and apply them to the object being built. This allows for the extension
        // of services, such as changing configuration or decorating the object.
        foreach ($this->getExtenders($abstract) as $extender) {
            $object = $extender($object, $this);
        }

        // If the requested type is registered as a singleton we'll want to cache off
        // the instances in "memory" so we can return it later without creating an
        // entirely new instance of an object on each subsequent request for it.
        if ($this->isShared($abstract) && ! $needsContextualBuild) {
            $this->instances[$abstract] = $object;
        }

        $this->fireResolvingCallbacks($abstract, $object);

        // Before returning, we will also set the resolved flag to "true" and pop off
        // the parameter overrides for this build. After those two things are done
        // we will be ready to return back the fully constructed class instance.
        $this->resolved[$abstract] = true;

        array_pop($this->with);

        return $object;
    }
    
...
}
    
```

## Larvel Service Container 사용법
- 대부분의 서비스 컨테이너 바인딩들은 서비스 프로바이더 내에서 등록됩니다.
- ServiceProvider 클래스를 상속하여 만든 클래스의 register method에 container  코드를 추가 한다.  
- [컨테이너 바인딩 방법](https://laravel.kr/docs/5.6/container#binding)
- 생성된 클래스는 config/app.php providers에 추가되어 있어야 한다. [참고](https://laravel.kr/docs/5.6/providers#registering-providers)
```
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(CityController::class)
        ->needs('App\Services\Stay\StayInterface')
        ->give('App\Services\Stay\Stay');
    }
}
```
- 생성자에 사용 클래스 추가
```
class CityController extends Controller
{
    private $stay;

    /**
     * CityController constructor.
     *
     * @param StayInterface $stay
     */
    public function __construct(StayInterface $stay)
    {
        $this->stay = $stay;
    }
}
```
