# FACADE
- 기본 sequence : request에서 response까지 라우터를 타고 어떻게 Controller가 호출되어 view 가 보여지는지?
  - index.php
    1. autoload
    1. new Application
      - registerBaseBindings
      - registerBaseServiceProviders
        - 각각의 주요 기능들을 Application에 bind
      - registerCoreContainerAliases
    1. bind important interfaces 
      - Illuminate\Contracts\Http\Kernel
      - Illuminate\Contracts\Console\Kernel
      - Illuminate\Contracts\Debug\ExceptionHandler
    1. make http\kernel
    1. request 
      - $kernel->handle( $request = Illuminate\Http\Request::capture() ) ; 
      - http\kernel@sendRequestThroughRouter > dispatchToRouter
        - Routing\Router@$this->router->dispatch($request); > $this->dispatchToRoute($request);        
          - > $this->runRoute($request, $this->findRoute($request)); >  $this->runRouteWithinStack($route, $request) > $route->run()
          - Routing\Route@$this->runController()
    1. response 
    1. terminate kernel
    
- Controller의 Facade들은 어떻게 static call 되어 질까?     
  - Cache::put() 호출 분석
    - 위 index.php new Application에 각 주요 기능들이 registerBaseServiceProviders를 통해 bind 되었기 때문에 static call 호출시 아래와 같은 flow로 처리 된다.
      - Cache::[method] 호출시 Facade의 __callStatic 호출 
      - __callStatic을 navigate 해보면 resolveFacadeInstance method에서 $app[$name]를 반환
      - $app[$name]은 Foundation\Application 클래스로 Container를 상송하고 있고 Container는 ArrayAcess를 Implement하면서 배열 형태 사용이 가능하다.
      - Container 배열형태 값 추출 method offsetGet을 보면 make method를 호출 하고 있고 navigation 하면 resolve method를 호출 한다. 
      - resolve method는 static call을 구체화 하는데 getConcrete method에서 서비스 프로바이더 등에서 bind되어진 정보를 참조하여 구체적인 클래스를 반환 한다.
      - 반환된 class를 기반하여 (의존성 해결 후) build method에서 ReflectionClass native class를 활용하여 객체를 생성하여 반환한다. 
      - singleton 설정 여부에 따라 해당 객체를 전역변수에 담아 사용할지 결정 한다. 
