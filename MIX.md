# Mix
- (https://laravel.kr/docs/5.4/mix)
- Mix는 자바스크립트 작업을 하는데 도움이 될만한 몇가지 기능을 제공하는데, ECMAScript 2015 컴파일, 모듈 번들링, minification, 그리고 자바스크립트 파일 concatenating-연결등입니다. 더 나아가 이 모든 기능은 여러가지 설정을 할 필요없이 원활하게 동작합니다:
```
mix.js('resources/assets/js/app.js', 'public/js');
```
- 이 한줄의 코드로 다음의 기능들을 취할 수 있습니다:
```
ES2015 syntax.
Modules
Compilation of .vue files.
Minification for production environments.
```
