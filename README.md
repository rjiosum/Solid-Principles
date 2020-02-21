# Software design principles

Some software design principles are:
- DRY (Don't Repeat Yourself)
- KISS (Keep It Simple, Stupid)
- YAGNI (You Aren't Gonna Need It)
- SOLID

### SOLID Principles
> S - SRP - Single Responsibility Principle

A class should have one and only one reason to change.


> O - OCP - Open Closed Principle

Software entities (classes, modules, functions, etc.) should be open for extension, but closed for modification.

When you have a class or method you want to extend without modifying it, separate the extensible behaviour behind an interface, and then flip the dependencies - Uncle Bob.


> L - LSP - Liskov Substitution Principle

If S is a subtype of T, then objects of type T may be replaced with objects of type S without altering any of the desirable properties of that program.

Derived classes must be substitutable for their base classes.

This means that the overridden methods should have the same signature, throwing the same type of exceptions and returning the same type of data.

Child pre-conditions cannot be greater than parent method pre-conditions.

Child post-conditions cannot be lesser than parent method post-conditions.

A pre-condition is a condition that happens before we execute a functionality.

A post-condition is a condition that happens after we execute a functionality.


> I - ISP - Interface Segregation Principle

No client should be forced to depend on method it does not use.

Many client-specific interfaces are better than one general purpose interfaces.


> D - DIP - Dependency Inversion Principle

High-level modules should not depend on low-level modules. Both should depend on abstraction.

Abstraction should not depend on details. Details should depend on abstraction.



