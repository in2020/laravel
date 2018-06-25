# Service Container
- [참고 사이트](https://www.laravel.co.kr/posts/258)
- 라라벨의 서비스 컨테이너는 클래스의 의존성을 관리하고 의존성을 주입하는 강력한 도구 입니다.[Document](https://laravel.kr/docs/5.6/container)
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
