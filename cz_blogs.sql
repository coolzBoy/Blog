-- MySQL dump 10.13  Distrib 5.7.11, for Win32 (AMD64)
--
-- Host: localhost    Database: cz_blogs
-- ------------------------------------------------------
-- Server version	5.7.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blogs_blog`
--

DROP TABLE IF EXISTS `blogs_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs_blog` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL DEFAULT '0',
  `replys` int(11) NOT NULL DEFAULT '0',
  `looks` int(11) NOT NULL DEFAULT '0',
  `title` text,
  `author` char(32) NOT NULL,
  `content` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs_blog`
--

LOCK TABLES `blogs_blog` WRITE;
/*!40000 ALTER TABLE `blogs_blog` DISABLE KEYS */;
INSERT INTO `blogs_blog` VALUES (1,0,2,14,'关于PHP','test','PHP是一种通用开源脚本语言，语法吸收了C、Java和Perl的特点，利于学习，使用广泛，主要适用于Web开发领域。它支持几乎所有流行的数据库以及操作系统，并可使用C、C++进行程序扩展。','2017-06-18 13:30:35'),(2,0,0,3,'MySQL优化经验','admin','同时在线访问量继续增大   对于1G内存的服务器明显感觉到吃力严重时甚至每天都会死机   或者时不时的服务器卡一下   这个问题曾经困扰了我半个多月MySQL使用是很具伸缩性的算法，因此你通常能用很少的内存运行或给MySQL更多的被存以得到更好的性能。 \n\n安装好mysql后，配制文件应该在/usr/local/mysql/share/mysql目录中，配制文件有几个，有my-   huge.cnf   my-medium.cnf   my-large.cnf   my-small.cnf,不同的流量的网站和不同配制的服务器环境，当然需要有不同的配制文件了。 \n\n一般的情况下，my-medium.cnf这个配制文件就能满足我们的大多需要；一般我们会把配置文件拷贝到/etc/my.cnf   只需要修改这个配置文件就可以了，使用mysqladmin   variables   extended-status   –u   root   –p   可以看到目前的参数，有３个配置参数是最重要的，即key_buffer_size,query_cache_size,table_cache。 \n\nkey_buffer_size只对MyISAM表起作用， \n\nkey_buffer_size指定索引缓冲区的大小，它决定索引处理的速度，尤其是索引读的速度。一般我们设为16M,实际上稍微大一点的站点　这个数 字是远远不够的，通过检查状态值Key_read_requests和Key_reads,可以知道key_buffer_size设置是否合理。比例 key_reads   /   key_read_requests应该尽可能的低，至少是1:100，1:1000更好（上述状态值可以使用SHOW   STATUS   LIKE   ‘key_read%’获得）。   或者如果你装了phpmyadmin   可以通过服务器运行状态看到,笔者推荐用phpmyadmin管理mysql','2017-06-18 13:37:51'),(3,0,1,4,'Linux+Apache+Mysql+PHP优化技巧','test','LAMP这个词的由来最早始于德国杂志“c\'t Magazine”，Michael Kunze在1990年最先把这些项目组合在一起创造了LAMP的缩写字。这些组件虽然并不是开开始就设计为一起使用的，但是，这些开源软件都可以很方便的随时获得并免费获得。这就导致了这些组件经常在一起使用。在过去的几年里，这些组件的兼容性不断完善，在一起的应用情形变得非常普便。为了改善不同组件之间的协作，已经创建了某些扩展功能。目前，几乎在所有的Linux发布版中都默认包含了“LAMP stack”的产品。这些产品组成了一个强大的Web应用程序平台 \n\n　　LAMP 平台由四个组件组成，呈分层结构。每一层都提供了整个软件栈的一个关键部分：\n\n　　Linux：Linux 处在最低层，提供操作系统。其他每个组件实际上也在 Linux 上运行。但是，并不一定局限于 Linux，如有必要，其他组件也可以在 Microsoft® Windows®、Mac OS X 或 UNIX® 上运行。\n\n　　Apache：次低层是 Apache，它是一个 Web 服务器。Apache 提供可让用户获得 Web 页面的机制。Apache 是一款稳定的、支持关键任务的服务器，Internet 上超过 65％ 的网站都使用它作为 Web 服务器。PHP 组件实际上是在 Apache 中，动态页面可以通过 Apache 和 PHP 创建。 \n\n　　MySQL：MySQL 提供 LAMP 系统的数据存储端。有了 MySQL，便可以获得一个非常强大的、适合运行大型复杂站点的数据库。在 Web 应用程序中，所有数据、产品、帐户和其他类型的信息都存放在这个数据库中，通过 SQL 语言可以很容易地查询这些信息。 \n\n　　PHP：PHP 是一门简单而有效的编程语言，它像是粘合剂，可以将 LAMP 系统所有其他的组件粘合在一起。您可以使用 PHP 编写能访问 MySQL 数据库中的数据和 Linux 提供的一些特性的动态内容。\n\n　　[检测工具]\n\n　　为了得到完整的调试结果，建议你采用 ApacheBench 或者 httperf之类的软件。如果你对非 LAMP 架构的服务器测试有兴趣的话，建议你采用微软的免费软件： Web Application Stress Tool（需要 NT 或者 2000）。（其它服务器测试工具）\n检测 Apache ，采用 top d 1 显示所有进程的 CPU 和内存情况。另外，还采用 apachectl status 命令\n\n　　[硬件优化]\n\n　　1、升级硬件的一般规则：对于 PHP 脚本而言，主要的瓶颈是 CPU ，对于静态页面而言，瓶颈是内存和网络。一台 400 Mhz 的普通奔腾机器所下载的静态页面就能让 T3 专线（45Mbps）饱和。 \n\n　　2、采用 hdparm 来优化磁盘，一般能提升 IDE 磁盘读写性能 200%，但是对 SCSI 硬盘也有效果。（不同类型的硬盘对比）\n\n　　[策略优化]\n\n　　3、Apache 处理 PHP 脚本的速度要比静态页面慢 2-10 倍，因此尽量采用多的静态页面，少的脚本。\n\n　　4、PHP 脚本如果不做缓冲，每次调用都需要编译，因此，安装一个 PHP 缓冲产品能提升 25-100% 的性能。\n\n　　5、如果你采用了 Linux 系统，建议升级内核到 2.4，因为静态页面由内核服务。\n\n　　6、另外一项缓冲技术是把不常修改的 PHP 页面采用 HTML 缓冲输出。\n\n　　7、不要在 Web 服务器上运行 X-Windows ，关掉没有必要运行的进程。 \n\n　　8、如果能够用文本就不要用图像，尽量减小图片的尺寸。 \n\n　　9、分散负载，把数据库服务器放到另外的机器上去。采用另外低端的机器服务图片和 HTML 页面，如果所有的静态页面在另外一台服务器上处理，可以设置 httpd.conf 中的 KeepAlives 为 off ，来减少断开连接的时间。\n\n　　10、以上所有的方法都是针对单机而言的，如果你觉得系统还是不够快，可以采用集群，负载均衡，缓冲技术。采用 Squid 作为缓冲，配置 Squid 的方法。 \n\n　　[编译优化]\n\n　　11、把基于文件的会话切换到基于共享内存的会话。编译 PHP 时采用 --with-mm 选项，在 php.ini 中设置 set session.save_handler=mm 。这个简单的修改能让会话管理时间缩短一半。\n\n　　12、采用最新版本的 Apache ，并把 PHP 编译其中，或者采用 DSO 模式，不要采用 CGI 方式。\n\n　　13、编译 PHP 时，建议采用如下的参数：\n--enable-inline-optimization --disable-debug \n\n　　[配置优化]\n\n　　14、修改 httpd.conf ： \n　　# 关闭 DNS lookups，PHP 脚本只拿 IP 地址\n　　HostnameLookups off \n\n　　15、如果网络拥挤，CPU 资源不够用，采用 PHP 的 HTML 压缩功能：\n　　output_handler = ob_gzhandler\n　　PHP 4.0.4 的用户请不要使用，因为存在内存泄漏问题。 \n\n　　16、修改 httpd.conf 中的 SendBufferSize 为你最大的页面文件的大小。加大内核的 TCP/IP 写缓冲大小。 \n\n　　17、采用数据库的持久连接时，不要把 MaxRequestsPerChild 设置得太大。\n\n　　[第三方软件优化]\n\n　　18、如果喜欢从修改 Apache 源码入手，可以安装 lingerd。在页面产生和发送后，每个 Apache 进程都会浪费一段时光在客户连接上，Lingerd 能接管这项工作，让 Apache 迅速服务下一个客户请求。 \n\n　　19、如果你足够勇敢的话，还可以采用 Silicon Graphics 的 Accelerated Apache 补丁。这个工程能使 Apache 1.3 快 10 倍，使 Apache 2.0 快 4 倍。\n\n　　安装一个 PHP 缓冲产品能提升 25-100% 的性能。 \n\n　　[Linux系统优化]\n\n　　1.清理服务器磁盘碎片： \n\n　　不论Linux文件系统采用什么文件格式（ext3、JFS、XFS、ReiserFS ）、何种类型的硬盘(IDE 、SCSI)，随着时间的推移文件系统都会趋向于碎片化。ext3、JFS等高级文件系统可以减少文件系统的碎片化，但是并没有消除。在繁忙的数据库服务器中，随着时间的过去，文件碎片化将降低硬盘性能，硬盘性能从硬盘读出或写入数据时才能注意到。时间长了会发现每个磁盘上确实积累了非常多的垃圾文件，释放磁盘空间可以帮助系统更好地工作。Linux最好的整理磁盘碎片的方法是做一个完全的备份，重新格式化分区，然后从备份恢复文件。但是对于7×24小时工作关键任务服务器来说是比较困难的。Kleandisk是一个高效的磁盘清理工具，它能把磁盘上的文件分成不同的\"组\",比如把所有的\"core\"文件归成一组（Group），这样要删除所有core文件时只要删除这个组就行了。core文件是当软件运行出错时产生的文件，它对于软件开发人员比较有用，对于其他用户（比如电子邮件服务器）却没有任何意义。因此，如果没有软件开发的需要，见到core文件就可以将其删除。 \n\n　　2、开启硬盘DMA \n\n　　现在使用的IDE硬盘基本支持DMA66/100/133（直接内存读取）但是Linux发行版本安装后一般没有打开，可以 /etc/rc.d/rc.local 最後面加上一行： /sbin/hdparm -d1 –x66 -c3 -m16 /dev/hda 这样以后每次开机，硬盘的 DMA 就会开启，不必每次手动设定。添加前后你可以使用命令：hdparm -Tt /dev/hda 来测试对比一下。 \n\n　　3、调整缓冲区刷新参数 \n\n　　Linux内核中，包含了一些对于系统运行态的可设置参数。缓冲刷新的参数可以通过调整 /proc/sys/vm/bdflush文件来完成，这个文件的格式是这样的： # cat /proc/sys/vm/bdflush 30 64 64 256 500 3000 60 0 0\n\n　　每一栏是一个参数，其中最重要的是前面几个参数。第一个数字是在\"dirty\"缓冲区达到多少的时候强制唤醒bdflush进程刷新硬盘，第二个数字是每次让bdflush进程刷新多少个dirty块。所谓dirty块是必须写到磁盘中的缓存块。接下来的参数是每次允许bd flush将多少个内存块排入空闲的缓冲块列表。 以上值为RHEL 4.0中的缺省值。可以使用两种方法修改： \n\n　　（1）使用命令 # echo \"100 128 128 512 5000 3000 60 0 0\">/proc/sys/vm/bdflush\n\n　　并将这条命令加到/etc/rc.d/rc.local文件中去。 \n\n　　（2）在/etc/sysctl.conf 文件中加入如下行: vm.bdflush = 100 128 128 512 5000 3000 60 0 0\n\n　　以上的设置加大了缓冲区大小，降低了bdflush被启动的频度，VFS的缓冲刷新机制是Linux文件系统高效的原因之一。 \n\n　　4、优化输入输出 \n\n　　I/O程序对Linux系统性能也是相当重要的，网络硬件I/O对服务器尤其重要。现在大多数Linux服务器使用10/100 Mb以太网。如果有较重的网络负载，则可以考虑千兆以太网卡。如果没有能力购买千兆网卡的话：可以使用多块网卡虚拟成为一块网卡，具有相同的IP地址。这项技术，在Linux中，这种技术称为Bonding。Bonding在Linux2.4以上内核中已经包含了，只需要在编译的时候把网络设备选项中的 Bonding driver support选中见图1。当然利用Bonding技术配置双网卡绑定的前提条件是两块网卡芯片组型号相同，并且都具备独立的BIOS芯片。\n\n　　然后，重新编译核心，重新起动计算机，执行如下命令：  #ismod bonding #ifconfig eth0 down #ifconfig eth1 down \n#ifconfig bond0 ipaddress#ifenslave bond0 eth0#ifenslave bond0 eth1\n\n　　现在两块网卡已经象一块一样工作了。这样可以提高集群节点间的数据传输.bonding对于服务器来是个比较好的选择,在没有千兆网卡时,用两块100兆网卡作bonding,可大大提高服务器到交换机之间的带宽.但是需要在交换机上设置连接bonding网卡的两个子口映射为同一个虚拟接口。编辑 /etc/modules.conf文件，加入如下内容，以使系统在启动时加载Bonding模块。  alias bond0 bonding options bond0 mode=0\n\n　　“mode”的值表示工作模式，共有0、1、2和3四种模式，这里设定为0。Bonding工作在负载均衡（Load Balancing (round-robin)）方式下，即两块网卡同时工作，这时理论上Bonding能提供两倍的带宽。Bonding运行在网卡的混杂（Promisc）模式下，而且它将两块网卡的MAC地址修改为一样的。混杂模式就是网卡不再只接收目的硬件地址是自身MAC地址的数据帧，而是可以接收网络上所有的帧。 ','2017-06-18 13:37:53'),(5,0,0,1,'php函数serialize()与unserialize()','cz666','erialize()和unserialize()在php手册上的解释是:\n\nserialize — Generates a storable representation of a value\n\nserialize — 产生一个可存储的值的表示\n\nunserialize — Creates a PHP value from a stored representation\n\nunserialize — 从已存储的表示中创建 PHP 的值\n\n很显然,\"a stored representation\"的解释翻译成了一个可存储的值后依然很让人非常费解它的意思。\n\n如果语言已经无法表述清楚，那么我们可以以一个具体的PHP的例子来学习这两个函数的用途\n\n \n\n<?php\n//声明一个类\nclass dog {\n\n    var $name;\n    var $age;\n    var $owner;\n\n    function dog($in_name=\"unnamed\",$in_age=\"0\",$in_owner=\"unknown\") {\n        $this->name = $in_name;\n        $this->age = $in_age;\n        $this->owner = $in_owner;\n    }\n\n    function getage() {\n        return ($this->age * 365);\n    }\n    \n    function getowner() {\n        return ($this->owner);\n    }\n    \n    function getname() {\n        return ($this->name);\n    }\n}\n//实例化这个类\n$ourfirstdog = new dog(\"Rover\",12,\"Lisa and Graham\");\n//用serialize函数将这个实例转化为一个序列化的字符串\n$dogdisc = serialize($ourfirstdog);\nprint $dogdisc; //$ourfirstdog 已经序列化为字符串 O:3:\"dog\":3:{s:4:\"name\";s:5:\"Rover\";s:3:\"age\";i:12;s:5:\"owner\";s:15:\"Lisa and Graham\";}\n\nprint \'<BR>\';\n\n/* \n-----------------------------------------------------------------------------------------\n    在这里你可以将字符串 $dogdisc 存储到任何地方如 session,cookie,数据库,php文件 \n-----------------------------------------------------------------------------------------\n*/\n\n//我们在此注销这个类\nunset($ourfirstdog);\n\n/*    还原操作   */\n\n/* \n-----------------------------------------------------------------------------------------\n    在这里将字符串 $dogdisc 从你存储的地方读出来如 session,cookie,数据库,php文件 \n-----------------------------------------------------------------------------------------\n*/\n\n\n//我们在这里用 unserialize() 还原已经序列化的对象\n$pet = unserialize($dogdisc); //此时的 $pet 已经是前面的 $ourfirstdog 对象了\n//获得年龄和名字属性\n$old = $pet->getage();\n$name = $pet->getname();\n//这个类此时无需实例化可以继续使用,而且属性和值都是保持在序列化之前的状态\nprint \"Our first dog is called $name and is $old days old<br>\";\nprint \'<BR>\';\n?>\n例子中的对象我们还可以换为数组等其他类型，效果都是一样的！\n\n其实serialize()就是将PHP中的变量如对象(object),数组(array)等等的值序列化为字符串后存储起来.序列化的字符串我们可以存储在其他地方如数据库、Session、Cookie等,序列化的操作并不会丢失这些值的类型和结构。这样这些变量的数据就可以在PHP页面、甚至是不同PHP程序间传递了。\n\n而unserialize()就是把序列化的字符串转换回PHP的值。\n\n这里再引用一段PHP手册上的说明，看了上面的例子，应该很容易明白下面这些话的意思了\n\n想要将已序列化的字符串变回 PHP 的值，可使用 unserialize()。serialize() 可处理除了 resource 之外的任何类型。甚至可以 serialize() 那些包含了指向其自身引用的数组。你正 serialize() 的数组／对象中的引用也将被存储。\n\n当序列化对象时，PHP 将试图在序列动作之前调用该对象的成员函数 __sleep()。这样就允许对象在被序列化之前做任何清除操作。类似的，当使用 unserialize() 恢复对象时， 将调用 __wakeup() 成员函数\n\nunserialize() 对单一的已序列化的变量进行操作，将其转换回 PHP 的值。返回的是转换之后的值，可为 integer、float、string、array 或 object。如果传递的字符串不可解序列化，则返回 FALSE。\n\n','2017-06-18 13:50:58'),(8,1,0,0,NULL,'test1','只是来占个楼','2017-06-19 01:21:51'),(9,0,1,4,'首家共享单车企业倒闭，下一个会是谁？','test','共享单车从不缺话题。\r\n“黄金圣斗士”单车、“彩虹单车”的图片还没刷屏多久，首家倒闭的共享单车企业——“悟空单车”，已经退出了这场大战。人们还来不及品味这则新闻，单车的两名投资“大佬”，一方是马化腾，一方则是朱啸虎，就“摩拜和OFO谁是老大”这个话题，在朋友圈怼了起来。\r\n关于共享单车的烧钱和争抢入场的资本与市场逻辑，侠客岛已经有过分析（《从共享单车到充电宝，创业风口还是资本做局？》）。就一个新行业业态而言，就着最新的新闻，我们似乎可以换一个角度审视：在OFO和摩拜两大巨头的阴影之下，其他五颜六色的共享单车企业，到底是如何生存的？这场资本与市场的大战，又将走向何处？','2017-06-19 05:29:11'),(16,0,0,2,'今天','cz666','今天做得不错！','2017-06-19 13:39:20'),(17,0,2,10,'摩拜单车完成6亿美元融资 共享单车行业开始“清场”','admin','6月16日，共享单车公司摩拜单车宣布完成6亿美元的E轮融资，创下共享单车行业单笔融资的最高纪录。本轮融资由腾讯领投，新引入的战略和财务投资者包括工银国际、交银国际、Farallon Capital等，TPG、红杉中国、高瓴资本等多家现有股东继续增持跟投。\r\n点评：摩拜单车以6亿美元创下行业单笔最高融资纪录，另一巨头ofo此前也传出在以30亿美元的估值寻求新一轮5亿美元的融资。这边厢两巨头不断获得融资，不但覆盖中国市场，还在努力向海外扩张。那边厢跟风者不断涌入，直呼“颜色不够用了”，土豪金、七彩色纷纷上阵。但与此同时，另一条消息却极少有人提及。那就是正式运营仅5个月的悟空单车宣布停止运营，退出共享单车市场。几家欢喜几家愁，这看起来似乎很正常。但如果将这几件事情联系起来进行观察，你就会发现，共享单车行业的发展正在步入一个新阶段，无论是资金、政策还是供应链都会向头部聚集，一大批中小玩家将被淘汰。“清场”即将开始。','2017-06-20 10:30:00'),(19,1,0,0,NULL,'admin','可以！！','2017-06-20 12:09:40'),(20,9,0,0,NULL,'admin','单车很好用！！','2017-06-21 00:56:05'),(21,17,0,0,NULL,'test1','膜拜搞事情？','2017-06-21 01:18:30'),(23,3,0,0,NULL,'test1','写的很详细！！','2017-06-21 01:28:02'),(24,0,0,0,'qw123','admin','asdfsd','2017-06-21 02:09:21'),(29,17,0,0,NULL,'test1','11','2017-06-21 05:30:09');
/*!40000 ALTER TABLE `blogs_blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs_user`
--

DROP TABLE IF EXISTS `blogs_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(32) NOT NULL,
  `password` char(32) NOT NULL,
  `sex` char(32) DEFAULT NULL,
  `touxiang` text,
  `birthday` char(32) DEFAULT NULL,
  `province` char(32) DEFAULT NULL,
  `userType` char(32) NOT NULL DEFAULT '普通用户',
  `qq` char(32) DEFAULT NULL,
  `mail` text,
  `regTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs_user`
--

LOCK TABLES `blogs_user` WRITE;
/*!40000 ALTER TABLE `blogs_user` DISABLE KEYS */;
INSERT INTO `blogs_user` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e','保密','public/upload/1.jpg','2000-1-1','河南省','管理员','1666666666','admin@ad.com.cn','2017-05-20 05:14:00'),(2,'test','46f94c8de14fb36680850768ff1b7f2a','男','public/upload/3.jpg','年-月-日','省份','普通用户','0','123@qq.com','2017-05-24 03:08:18'),(3,'cz666','46f94c8de14fb36680850768ff1b7f2a','保密','public/upload/1.jpg','1996-6-6','河南省','普通用户','12345678','asd@aa.cn','2017-05-24 03:12:18'),(4,'test1','46f94c8de14fb36680850768ff1b7f2a','保密','','2001-1-1','北京市','普通用户','','12@test.cn','2017-06-02 01:11:49'),(5,'aa','202cb962ac59075b964b07152d234b70',NULL,NULL,'年-月-日',NULL,'普通用户',NULL,NULL,'2017-06-21 01:47:16'),(6,'abc','202cb962ac59075b964b07152d234b70',NULL,NULL,'年-月-日',NULL,'普通用户',NULL,NULL,'2017-06-21 01:50:40');
/*!40000 ALTER TABLE `blogs_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-27  9:35:17
