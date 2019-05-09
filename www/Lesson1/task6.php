<?php

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {

}
$a1 = new A();
$b1 = new B();
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo();

// 6. Объясните результаты в этом случае.
/*
Выведет 1122
Аналогично как в и п.5 создается статическая переменная
Однако хоть и используется наследование $a1 и $b1 обращается к разным сущностям. В этом случае статическая переменная у них разная.

*/