#### 一.项目简介

本应用有两个主要功能：文件上传和论坛发帖回复功能

#### 二.文件结构简介

##### 文件夹

1 config-配置文件，内含database类

2 files_share-文件上传，内含file_create和file_read两个php文件，用于具体实现cr功能，files文件夹用于存储

3 forum-论坛，内涵index所有post内容缩略php，post的crud，reply的crd，其中post_read.php身负重任，post的read功能，以及delete（使用ajax）和update功能接口，reply的create、read和delete都在这里

4 img-存储首页图，没大用处

5 layout-布局，也没大用处

6 objects-三个类，post、reply和file，这个算核心

##### 文件

1 index.html 首页

2 readme.md 写了对该项目的介绍

3 zhang_yunwen.sql 写了mysql语句



##### 逻辑介绍

先写一个database的class，内含get_connection功能用PDO实现与数据库的连接，以及redirect功能实现跳转；

再写与mysql里三个表格对应的三个class，class内含属性，crud的function；

最后写很多的php，调用class里面的各种function来实现功能



#### 三.可能遇到的问题

##### 时间戳不对

尝试date('Y-m-d H:i:s') ，并把时间的mysql数据类型改为timestamp(0)

##### ajax无法调用

无能为力，看几遍老师的例子尝试理解，仔细检查语法

##### 获取不到id

检查文件之间是否建立了连接，检查form表单method方法，检查是否弄混淆$_GET与$_POST方法

##### sql语句错误

注意sql语句里面，所赋的值只要是字符串，不管是varchar还是char，都需要'',因此到时候语句里可能很多单引号双引号粘连符别弄错了



#### 四.参考

https://www.codeofaninja.com/2014/06/php-object-oriented-crud-example-oop.html