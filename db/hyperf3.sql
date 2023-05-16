/*
 Navicat MySQL Data Transfer

 Source Server         : 本地服务器88
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : hyperf3

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 15/05/2023 17:18:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for hy_goods
-- ----------------------------
DROP TABLE IF EXISTS `hy_goods`;
CREATE TABLE `hy_goods`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '商品标题',
  `sku_id` int NOT NULL DEFAULT 0,
  `type` int NOT NULL DEFAULT 0 COMMENT '商品类型 1普通商品',
  `category_id` int NOT NULL DEFAULT 0 COMMENT '商品分类',
  `unit` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '单位',
  `is_video` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否添加视频',
  `video_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '视频类型 1本地视频 2视频地址',
  `video_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '视频地址',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态:0下架 1上架 2:售罄',
  `specification` tinyint(1) NOT NULL DEFAULT 1 COMMENT '商品规格1单规格 2多规格',
  `price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '售价',
  `market_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '成本',
  `cost_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '原价',
  `stock` int NOT NULL DEFAULT 0 COMMENT '库存',
  `product_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '商品编号',
  `weight` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '体重',
  `volume` int NOT NULL DEFAULT 0 COMMENT '体积',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL COMMENT '描述',
  `logistics_type` json NULL COMMENT '物流方式',
  `logistics_cate` tinyint(1) NOT NULL DEFAULT 1 COMMENT '运费设置',
  `logistics_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '运费固定金额',
  `logistics_formwork` int NOT NULL DEFAULT 0 COMMENT '运费模板',
  `number` int NOT NULL DEFAULT 0 COMMENT '已购数量',
  `integral` int NOT NULL DEFAULT 0 COMMENT '购买赠送积分',
  `is_purchase` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否限购',
  `purchase_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '单次限购',
  `purchase_number` int NOT NULL DEFAULT 0 COMMENT '限购数量',
  `is_booking` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否预售 0不预售 1预售',
  `booking_send_time` int NOT NULL DEFAULT 0 COMMENT '预售发货时间',
  `recommend` json NULL COMMENT '促销',
  `title_keywords` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `title_description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `delete_time` int NULL DEFAULT NULL,
  `create_time` int NOT NULL DEFAULT 0,
  `update_time` int NOT NULL DEFAULT 0,
  `banner` json NULL,
  `url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `booking_time_start` int NOT NULL DEFAULT 0,
  `booking_time_end` int NOT NULL DEFAULT 0,
  `sort` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_goods
-- ----------------------------
INSERT INTO `hy_goods` VALUES (1, '测试商品', 16, 1, 3, '多规格', 1, 2, 'http://vod.v.jstv.com/2021/04/09/JSTV_JSWS_1617981143954_5uynjqx_1767.mp4', 3, 2, 1.00, 3.00, 2.00, 64, '0', '0', 0, '<p>{</p><p> &nbsp; &nbsp;\"id\": \"0\",</p><p> &nbsp; &nbsp;\"type\": 1,</p><p> &nbsp; &nbsp;\"title\": \"测试商品\",</p><p> &nbsp; &nbsp;\"category_id\": 3,</p><p> &nbsp; &nbsp;\"unit\": \"单规格\",</p><p> &nbsp; &nbsp;\"is_video\": 1,</p><p> &nbsp; &nbsp;\"video_type\": 2,</p><p> &nbsp; &nbsp;\"video_url\": \"\",</p><p> &nbsp; &nbsp;\"status\": 1,</p><p> &nbsp; &nbsp;\"specification\": 1,</p><p> &nbsp; &nbsp;\"price\": 1,</p><p> &nbsp; &nbsp;\"market_price\": 2,</p><p> &nbsp; &nbsp;\"cost_price\": 3,</p><p> &nbsp; &nbsp;\"stock\": 21,</p><p> &nbsp; &nbsp;\"product_id\": 0,</p><p> &nbsp; &nbsp;\"weight\": 0,</p><p> &nbsp; &nbsp;\"volume\": 0,</p><p> &nbsp; &nbsp;\"description\": \"&lt;p&gt;1、前言&lt;/p&gt;&lt;p&gt;很多时候我们需要获取一个结构未知的文件夹下所有的文件或是指定类型的所有文件，在C#中可以通过递归实现，下面给出实现代码。我这里新建了一个测试文件夹，其结构如下所示：&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;测试文件夹/&lt;/p&gt;&lt;p&gt; &nbsp;├─文件夹1&lt;/p&gt;&lt;p&gt; &nbsp;│ &nbsp; └─1_1.docx&lt;/p&gt;&lt;p&gt; &nbsp;│ &nbsp; └─1_2.docx &lt;/p&gt;&lt;p&gt; &nbsp;└─文件夹2&lt;/p&gt;&lt;p&gt; &nbsp;│ &nbsp; └─2_1.pptx&lt;/p&gt;&lt;p&gt; &nbsp;│ &nbsp; └─2_2.pptx &lt;/p&gt;&lt;p&gt; &nbsp;│ &nbsp; └─文件夹3&lt;/p&gt;&lt;p&gt; &nbsp;│ &nbsp; &nbsp; &nbsp;└─3_1.xlsx&lt;/p&gt;&lt;p&gt; &nbsp;│ &nbsp; &nbsp; &nbsp;└─3_2.xlsx&lt;/p&gt;&lt;p&gt; &nbsp;│ &nbsp; &nbsp; &nbsp;└─文件夹4&lt;/p&gt;&lt;p&gt; &nbsp;│ &nbsp; &nbsp; &nbsp; &nbsp; └─4_1.bmp&lt;/p&gt;&lt;p&gt; &nbsp;│ &nbsp; &nbsp; &nbsp; &nbsp; └─4_2.bmp&lt;/p&gt;&lt;p&gt;1&lt;/p&gt;&lt;p&gt;2&lt;/p&gt;&lt;p&gt;3&lt;/p&gt;&lt;p&gt;4&lt;/p&gt;&lt;p&gt;5&lt;/p&gt;&lt;p&gt;6&lt;/p&gt;&lt;p&gt;7&lt;/p&gt;&lt;p&gt;8&lt;/p&gt;&lt;p&gt;9&lt;/p&gt;&lt;p&gt;10&lt;/p&gt;&lt;p&gt;11&lt;/p&gt;&lt;p&gt;12&lt;/p&gt;&lt;p&gt;13&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;2、获取全部文件&lt;/p&gt;&lt;p&gt;获取全部文件代码如下：&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;using System;&lt;/p&gt;&lt;p&gt;using System.Collections.Generic;&lt;/p&gt;&lt;p&gt;using System.IO;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;namespace App&lt;/p&gt;&lt;p&gt;{&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp;class Program&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp;{&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp;static void Main(string[] args)&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp;{&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;List&lt;string&gt; files = GetFiles(@\\\"D:\\\\测试文件夹\\\");&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;foreach (var item in files)&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Console.WriteLine(item);&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;}&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Console.ReadKey();&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp;}&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp;static List&lt;string&gt; GetFiles(string directory, string pattern = \\\"*.*\\\")&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp;{&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;List&lt;string&gt; files = new List&lt;string&gt;();&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;foreach (var item in Directory.GetFiles(directory, pattern))&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;files.Add(item);&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;}&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;foreach (var item in Directory.GetDirectories(directory))&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;files.AddRange(GetFiles(item, pattern));&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;}&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;return files;&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp; &nbsp; &nbsp;}&lt;/p&gt;&lt;p&gt; &nbsp; &nbsp;}&lt;/p&gt;&lt;p&gt;}&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;1&lt;/p&gt;&lt;p&gt;2&lt;/p&gt;&lt;p&gt;3&lt;/p&gt;&lt;p&gt;4&lt;/p&gt;&lt;p&gt;5&lt;/p&gt;&lt;p&gt;6&lt;/p&gt;&lt;p&gt;7&lt;/p&gt;&lt;p&gt;8&lt;/p&gt;&lt;p&gt;9&lt;/p&gt;&lt;p&gt;10&lt;/p&gt;&lt;p&gt;11&lt;/p&gt;&lt;p&gt;12&lt;/p&gt;&lt;p&gt;13&lt;/p&gt;&lt;p&gt;14&lt;/p&gt;&lt;p&gt;15&lt;/p&gt;&lt;p&gt;16&lt;/p&gt;&lt;p&gt;17&lt;/p&gt;&lt;p&gt;18&lt;/p&gt;&lt;p&gt;19&lt;/p&gt;&lt;p&gt;20&lt;/p&gt;&lt;p&gt;21&lt;/p&gt;&lt;p&gt;22&lt;/p&gt;&lt;p&gt;23&lt;/p&gt;&lt;p&gt;24&lt;/p&gt;&lt;p&gt;25&lt;/p&gt;&lt;p&gt;26&lt;/p&gt;&lt;p&gt;27&lt;/p&gt;&lt;p&gt;28&lt;/p&gt;&lt;p&gt;29&lt;/p&gt;&lt;p&gt;30&lt;/p&gt;&lt;p&gt;31&lt;/p&gt;&lt;p&gt;32&lt;/p&gt;&lt;p&gt;33&lt;/p&gt;&lt;p&gt;结果如下图所示：&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;D:\\\\测试文件夹\\\\文件夹1\\\\1_1.docx&lt;/p&gt;&lt;p&gt;D:\\\\测试文件夹\\\\文件夹1\\\\1_2.docx&lt;/p&gt;&lt;p&gt;D:\\\\测试文件夹\\\\文件夹2\\\\2_1.pptx&lt;/p&gt;&lt;p&gt;D:\\\\测试文件夹\\\\文件夹2\\\\2_2.pptx&lt;/p&gt;&lt;p&gt;D:\\\\测试文件夹\\\\文件夹2\\\\文件夹3\\\\3_1.xlsx&lt;/p&gt;&lt;p&gt;D:\\\\测试文件夹\\\\文件夹2\\\\文件夹3\\\\3_2.xlsx&lt;/p&gt;&lt;p&gt;D:\\\\测试文件夹\\\\文件夹2\\\\文件夹3\\\\文件夹4\\\\4_1.bmp&lt;/p&gt;&lt;p&gt;D:\\\\测试文件夹\\\\文件夹2\\\\文件夹3\\\\文件夹4\\\\4_2.bmp&lt;/p&gt;&lt;p&gt;1&lt;/p&gt;&lt;p&gt;2&lt;/p&gt;&lt;p&gt;3&lt;/p&gt;&lt;p&gt;4&lt;/p&gt;&lt;p&gt;5&lt;/p&gt;&lt;p&gt;6&lt;/p&gt;&lt;p&gt;7&lt;/p&gt;&lt;p&gt;8&lt;/p&gt;&lt;p&gt;3、获取指定类型文件&lt;/p&gt;&lt;p&gt;————————————————&lt;/p&gt;&lt;p&gt;版权声明：本文为CSDN博主「HerryDong」的原创文章，遵循CC 4.0 BY-SA版权协议，转载请附上原文出处链接及本声明。&lt;/p&gt;&lt;p&gt;原文链接：https://blog.csdn.net/HerryDong/article/details/103250077&lt;/p&gt;\",</p><p> &nbsp; &nbsp;\"logistics_type\": [</p><p> &nbsp; &nbsp; &nbsp; &nbsp;\"1\"</p><p> &nbsp; &nbsp;],</p><p> &nbsp; &nbsp;\"logistics_cate\": 1,</p><p> &nbsp; &nbsp;\"logistics_price\": 0,</p><p> &nbsp; &nbsp;\"logistics_formwork\": 0,</p><p> &nbsp; &nbsp;\"number\": 0,</p><p> &nbsp; &nbsp;\"sort\": 0,</p><p> &nbsp; &nbsp;\"integral\": 10,</p><p> &nbsp; &nbsp;\"is_purchase\": 0,</p><p> &nbsp; &nbsp;\"purchase_type\": 1,</p><p> &nbsp; &nbsp;\"purchase_number\": 0,</p><p> &nbsp; &nbsp;\"is_booking\": 0,</p><p> &nbsp; &nbsp;\"booking_time\": 0,</p><p> &nbsp; &nbsp;\"booking_send_time\": 0,</p><p> &nbsp; &nbsp;\"recommend\": [</p><p> &nbsp; &nbsp; &nbsp; &nbsp;1,</p><p> &nbsp; &nbsp; &nbsp; &nbsp;2,</p><p> &nbsp; &nbsp; &nbsp; &nbsp;3</p><p> &nbsp; &nbsp;],</p><p> &nbsp; &nbsp;\"title_keywords\": \"\",</p><p> &nbsp; &nbsp;\"title_description\": \"\",</p><p> &nbsp; &nbsp;\"sku_data\": [],</p><p> &nbsp; &nbsp;\"banner\": [</p><p> &nbsp; &nbsp; &nbsp; &nbsp;{</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"id\": 23,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"url\": \"/public/image/2023-03-24/af08df99616e3e4f1038b161ffcdaf70.jpeg\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"cate_id\": 0,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"md5\": \"af08df99616e3e4f1038b161ffcdaf70\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"size\": \"\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"fileName\": \"ChMkLGN1liWIUfnuAACT6RmJ2J0AAJvMQJvgaUAAJQB562.jpg\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"type\": \"image\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"ext\": \"jpeg\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"upload_ip\": 3232235529,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"status\": 1,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"create_time\": \"0\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"update_time\": \"0\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"delete_time\": null,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"checked\": true</p><p> &nbsp; &nbsp; &nbsp; &nbsp;},</p><p> &nbsp; &nbsp; &nbsp; &nbsp;{</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"id\": 24,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"url\": \"/public/image/2023-03-24/f45e58d0a0c8dad652a12ad3c7963c0d.jpeg\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"cate_id\": 0,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"md5\": \"f45e58d0a0c8dad652a12ad3c7963c0d\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"size\": \"\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"fileName\": \"ChMkK2N1li6IKrkVAAEAb8Nx1agAAJvMQMkV5cAAQCH804.jpg\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"type\": \"image\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"ext\": \"jpeg\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"upload_ip\": 3232235529,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"status\": 1,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"create_time\": \"0\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"update_time\": \"0\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"delete_time\": null,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"checked\": true</p><p> &nbsp; &nbsp; &nbsp; &nbsp;},</p><p> &nbsp; &nbsp; &nbsp; &nbsp;{</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"id\": 26,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"url\": \"/public/image/2023-03-24/cadae5ccd8bfe93c4f80446a1bac899a.jpeg\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"cate_id\": 0,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"md5\": \"cadae5ccd8bfe93c4f80446a1bac899a\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"size\": \"\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"fileName\": \"ChMkLGN1liiIOiwvAAED3OG0Qq0AAJvMQKvM3wAAQP0820.jpg\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"type\": \"image\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"ext\": \"jpeg\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"upload_ip\": 3232235529,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"status\": 1,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"create_time\": \"0\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"update_time\": \"0\",</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"delete_time\": null,</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"checked\": true</p><p> &nbsp; &nbsp; &nbsp; &nbsp;}</p><p> &nbsp; &nbsp;],</p><p> &nbsp; &nbsp;\"goods_img\": \"/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg\"</p><p>}<img src=\"/public/image/7c70cb048c20e4f883fae48e489b14cf.jpg\" alt=\"\" data-href=\"\" style=\"\"/></p>', '[\"1\"]', 1, 0.00, 0, 0, 0, 0, 1, 0, 0, 0, '[1, 2, 3]', '', '', NULL, 1680315459, 1680316013, '[\"/public/image/2023-03-24/af08df99616e3e4f1038b161ffcdaf70.jpeg\", \"/public/image/2023-03-24/f45e58d0a0c8dad652a12ad3c7963c0d.jpeg\", \"/public/image/2023-03-24/cadae5ccd8bfe93c4f80446a1bac899a.jpeg\"]', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 0, 0, 0);
INSERT INTO `hy_goods` VALUES (2, '测试商品', 75, 1, 3, '111', 0, 1, '', 1, 2, 1.00, 3.00, 2.00, 480, '0', '0', 0, '<p>1、前言</p><p>很多时候我们需要获取一个结构未知的文件夹下所有的文件或是指定类型的所有文件，在C#中可以通过递归实现，下面给出实现代码。我这里新建了一个测试文件夹，其结构如下所示：</p><p><br></p><p>测试文件夹/</p><p> &nbsp;├─文件夹1</p><p> &nbsp;│ &nbsp; └─1_1.docx</p><p> &nbsp;│ &nbsp; └─1_2.docx </p><p> &nbsp;└─文件夹2</p><p> &nbsp;│ &nbsp; └─2_1.pptx</p><p> &nbsp;│ &nbsp; └─2_2.pptx </p><p> &nbsp;│ &nbsp; └─文件夹3</p><p> &nbsp;│ &nbsp; &nbsp; &nbsp;└─3_1.xlsx</p><p> &nbsp;│ &nbsp; &nbsp; &nbsp;└─3_2.xlsx</p><p> &nbsp;│ &nbsp; &nbsp; &nbsp;└─文件夹4</p><p> &nbsp;│ &nbsp; &nbsp; &nbsp; &nbsp; └─4_1.bmp</p><p> &nbsp;│ &nbsp; &nbsp; &nbsp; &nbsp; └─4_2.bmp</p><p>1</p><p>2</p><p>3</p><p>4</p><p>5</p><p>6</p><p>7</p><p>8</p><p>9</p><p>10</p><p>11</p><p>12</p><p>13</p><p><br></p><p><br></p><p>2、获取全部文件</p><p>获取全部文件代码如下：</p><p><br></p><p>using System;</p><p>using System.Collections.Generic;</p><p>using System.IO;</p><p><br></p><p>namespace App</p><p>{</p><p> &nbsp; &nbsp;class Program</p><p> &nbsp; &nbsp;{</p><p> &nbsp; &nbsp; &nbsp; &nbsp;static void Main(string[] args)</p><p> &nbsp; &nbsp; &nbsp; &nbsp;{</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;List&lt;string&gt; files = GetFiles(@\"D:\\测试文件夹\");</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;foreach (var item in files)</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Console.WriteLine(item);</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;}</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Console.ReadKey();</p><p> &nbsp; &nbsp; &nbsp; &nbsp;}</p><p><br></p><p> &nbsp; &nbsp; &nbsp; &nbsp;static List&lt;string&gt; GetFiles(string directory, string pattern = \"*.*\")</p><p> &nbsp; &nbsp; &nbsp; &nbsp;{</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;List&lt;string&gt; files = new List&lt;string&gt;();</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;foreach (var item in Directory.GetFiles(directory, pattern))</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;files.Add(item);</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;}</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;foreach (var item in Directory.GetDirectories(directory))</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;files.AddRange(GetFiles(item, pattern));</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;}</p><p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;return files;</p><p> &nbsp; &nbsp; &nbsp; &nbsp;}</p><p> &nbsp; &nbsp;}</p><p>}</p><p><br></p><p>1</p><p>2</p><p>3</p><p>4</p><p>5</p><p>6</p><p>7</p><p>8</p><p>9</p><p>10</p><p>11</p><p>12</p><p>13</p><p>14</p><p>15</p><p>16</p><p>17</p><p>18</p><p>19</p><p>20</p><p>21</p><p>22</p><p>23</p><p>24</p><p>25</p><p>26</p><p>27</p><p>28</p><p>29</p><p>30</p><p>31</p><p>32</p><p>33</p><p>结果如下图所示：</p><p><br></p><p>D:\\测试文件夹\\文件夹1\\1_1.docx</p><p>D:\\测试文件夹\\文件夹1\\1_2.docx</p><p>D:\\测试文件夹\\文件夹2\\2_1.pptx</p><p>D:\\测试文件夹\\文件夹2\\2_2.pptx</p><p>D:\\测试文件夹\\文件夹2\\文件夹3\\3_1.xlsx</p><p>D:\\测试文件夹\\文件夹2\\文件夹3\\3_2.xlsx</p><p>D:\\测试文件夹\\文件夹2\\文件夹3\\文件夹4\\4_1.bmp</p><p>D:\\测试文件夹\\文件夹2\\文件夹3\\文件夹4\\4_2.bmp</p><p>1</p><p>2</p><p>3</p><p>4</p><p>5</p><p>6</p><p>7</p><p>8</p><p>3、获取指定类型文件</p><p>————————————————</p><p>版权声明：本文为CSDN博主「HerryDong」的原创文章，遵循CC 4.0 BY-SA版权协议，转载请附上原文出处链接及本声明。</p><p>原文链接：https://blog.csdn.net/HerryDong/article/details/103250077</p>', '[\"1\"]', 1, 0.00, 0, 0, 0, 0, 1, 0, 0, 0, '[1, 2, 3]', '', '', NULL, 1680509484, 1680509484, '[\"/public/image/2023-03-24/af08df99616e3e4f1038b161ffcdaf70.jpeg\", \"/public/image/2023-03-24/f45e58d0a0c8dad652a12ad3c7963c0d.jpeg\", \"/public/image/2023-03-24/cadae5ccd8bfe93c4f80446a1bac899a.jpeg\", \"/public/image/2023-03-24/1e55ea5a72fdf654a011517737e07d0c.jpeg\"]', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 0, 0, 0);
INSERT INTO `hy_goods` VALUES (6, '单规格', 78, 1, 3, '件', 0, 1, '', 1, 1, 1.00, 10.00, 1.00, 1, '0', '0', 0, '&lt;p&gt;这是描述文件&lt;/p&gt;', '[\"1\"]', 1, 100.00, 0, 1, 3, 1, 2, 4, 1, 10, '[2, 1, 3]', '1', '2', NULL, 1680510133, 1680510133, '[\"/public/image/2023-03-24/ae752e825c6b49875e13d9f5ea15b67c.jpeg\", \"/public/image/2023-03-24/cadae5ccd8bfe93c4f80446a1bac899a.jpeg\", \"/public/image/2023-03-24/1e55ea5a72fdf654a011517737e07d0c.jpeg\"]', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1680710400, 1685030400, 2);

-- ----------------------------
-- Table structure for hy_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `hy_goods_category`;
CREATE TABLE `hy_goods_category`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '标题',
  `sort` int NOT NULL DEFAULT 0 COMMENT '排序',
  `logo` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '分类图标',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_time` int NOT NULL DEFAULT 0,
  `update_time` int NOT NULL DEFAULT 0,
  `delete_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '商品分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_goods_category
-- ----------------------------
INSERT INTO `hy_goods_category` VALUES (1, 'test12', 0, '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1, 1679477167, 1679477731, 1679477731);
INSERT INTO `hy_goods_category` VALUES (2, '234234', 0, '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1, 1679477741, 1679477748, 1679477748);
INSERT INTO `hy_goods_category` VALUES (3, '家电', 10, '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1, 1679535294, 1679535294, NULL);
INSERT INTO `hy_goods_category` VALUES (4, '美食', 0, '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1, 1679535304, 1679535304, NULL);

-- ----------------------------
-- Table structure for hy_goods_sku
-- ----------------------------
DROP TABLE IF EXISTS `hy_goods_sku`;
CREATE TABLE `hy_goods_sku`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `goods_id` int NOT NULL DEFAULT 0 COMMENT '商品id',
  `specs_id` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '商品图片',
  `price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '售价',
  `market_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '成本价',
  `cost_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '原价',
  `stock` int NOT NULL DEFAULT 0 COMMENT '成本价',
  `product_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_time` int NOT NULL DEFAULT 0,
  `update_time` int NOT NULL DEFAULT 0,
  `delete_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 79 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '商品sku表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_goods_sku
-- ----------------------------
INSERT INTO `hy_goods_sku` VALUES (1, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (2, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (3, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (4, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (5, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (6, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (7, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (8, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (9, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (10, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (11, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (12, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (13, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (14, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (15, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (16, 1, '', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 4, '', 1, 1680315459, 1680315459, NULL);
INSERT INTO `hy_goods_sku` VALUES (17, 2, '27,23', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 3.00, 2.00, 4, '', 1, 1680504169, 1680509484, 1680509484);
INSERT INTO `hy_goods_sku` VALUES (18, 2, '27,22', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 3.00, 2.00, 4, '', 1, 1680504169, 1680509484, 1680509484);
INSERT INTO `hy_goods_sku` VALUES (19, 2, '27,21', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 3.00, 2.00, 4, '', 1, 1680504169, 1680509484, 1680509484);
INSERT INTO `hy_goods_sku` VALUES (20, 2, '26,23', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 3.00, 2.00, 4, '', 1, 1680504169, 1680509484, 1680509484);
INSERT INTO `hy_goods_sku` VALUES (21, 2, '26,22', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 3.00, 2.00, 4, '', 1, 1680504169, 1680509484, 1680509484);
INSERT INTO `hy_goods_sku` VALUES (22, 2, '26,21', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 3.00, 2.00, 4, '', 1, 1680504169, 1680509484, 1680509484);
INSERT INTO `hy_goods_sku` VALUES (23, 2, '25,23', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 3.00, 10.00, 4, '', 1, 1680504169, 1680509484, 1680509484);
INSERT INTO `hy_goods_sku` VALUES (24, 2, '25,22', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 3.00, 2.00, 4, '', 1, 1680504169, 1680509484, 1680509484);
INSERT INTO `hy_goods_sku` VALUES (25, 2, '25,21', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 3.00, 2.00, 4, '', 1, 1680504169, 1680509484, 1680509484);
INSERT INTO `hy_goods_sku` VALUES (27, 6, '', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 10.00, 1.00, 1, '', 1, 1680510133, 1680510133, NULL);
INSERT INTO `hy_goods_sku` VALUES (28, 2, '21,25,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (29, 2, '21,25,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (30, 2, '21,25,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (31, 2, '21,26,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (32, 2, '21,26,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (33, 2, '21,26,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (34, 2, '21,27,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (35, 2, '21,27,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (36, 2, '21,27,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (37, 2, '21,24,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (38, 2, '21,24,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (39, 2, '21,24,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (40, 2, '22,25,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (41, 2, '22,25,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (42, 2, '22,25,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (43, 2, '22,26,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (44, 2, '22,26,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (45, 2, '22,26,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (46, 2, '22,27,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (47, 2, '22,27,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (48, 2, '22,27,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (49, 2, '22,24,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (50, 2, '22,24,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (51, 2, '22,24,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (52, 2, '23,25,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (53, 2, '23,25,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (54, 2, '23,25,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (55, 2, '23,26,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (56, 2, '23,26,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (57, 2, '23,26,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (58, 2, '23,27,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (59, 2, '23,27,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (60, 2, '23,27,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (61, 2, '23,24,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (62, 2, '23,24,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (63, 2, '23,24,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (64, 2, '20,25,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (65, 2, '20,25,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (66, 2, '20,25,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (67, 2, '20,26,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (68, 2, '20,26,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (69, 2, '20,26,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (70, 2, '20,27,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (71, 2, '20,27,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (72, 2, '20,27,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (73, 2, '20,24,9', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (74, 2, '20,24,8', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (75, 2, '20,24,7', '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 1.00, 3.00, 2.00, 10, '', 1, 1680509484, 1680509484, NULL);
INSERT INTO `hy_goods_sku` VALUES (76, 6, '', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 10.00, 1.00, 1, '', 1, 1680510133, 1680510133, NULL);
INSERT INTO `hy_goods_sku` VALUES (77, 6, '', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 10.00, 1.00, 1, '', 1, 1680510133, 1680510133, NULL);
INSERT INTO `hy_goods_sku` VALUES (78, 6, '', '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 1.00, 10.00, 1.00, 1, '', 1, 1680510133, 1680510133, NULL);

-- ----------------------------
-- Table structure for hy_member
-- ----------------------------
DROP TABLE IF EXISTS `hy_member`;
CREATE TABLE `hy_member`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nickName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `openid` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '唯一识别号',
  `mobile` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `userName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `header_img` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '头像',
  `realName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_time` int NOT NULL DEFAULT 0,
  `update_time` int NOT NULL DEFAULT 0,
  `delete_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq_openid`(`openid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '前端用户信息' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_member
-- ----------------------------
INSERT INTO `hy_member` VALUES (1, '', '1233323', '', '', '', '', 1, 1681959726, 1681959726, NULL);

-- ----------------------------
-- Table structure for hy_member_token
-- ----------------------------
DROP TABLE IF EXISTS `hy_member_token`;
CREATE TABLE `hy_member_token`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `openid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_time` int NOT NULL DEFAULT 0,
  `delete_time` int NULL DEFAULT NULL,
  `update_time` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '微信登陆session' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_member_token
-- ----------------------------
INSERT INTO `hy_member_token` VALUES (3, '22222', '1233323', 1, 0, NULL, 1681960344);

-- ----------------------------
-- Table structure for hy_menu
-- ----------------------------
DROP TABLE IF EXISTS `hy_menu`;
CREATE TABLE `hy_menu`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '菜单名称 国际化',
  `pid` int UNSIGNED NOT NULL DEFAULT 0,
  `menuType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '菜单类型',
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '地址',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '简称',
  `component` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `redirect` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '重定向',
  `isLink` int NOT NULL DEFAULT 0 COMMENT '是否是地址',
  `link_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '外链地址',
  `isHide` tinyint(1) NOT NULL DEFAULT 0,
  `isKeepAlive` tinyint(1) NOT NULL DEFAULT 1,
  `isAffix` tinyint(1) NOT NULL DEFAULT 0,
  `isIframe` tinyint UNSIGNED NOT NULL DEFAULT 0,
  `icon` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `sort` int NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_time` int UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int UNSIGNED NOT NULL DEFAULT 0,
  `delete_time` int UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_menu
-- ----------------------------
INSERT INTO `hy_menu` VALUES (1, 'message.router.home', 0, 'menu', '/home', 'home', 'home/index', '', 0, '', 0, 1, 1, 0, 'iconfont icon-shouye', 0, 1, 0, 0, NULL);
INSERT INTO `hy_menu` VALUES (2, 'message.router.system', 0, 'menu', '/system', 'system', 'layout/routerView/parent', '/system/menu', 0, '', 0, 1, 0, 0, 'iconfont icon-xitongshezhi', 0, 1, 0, 0, NULL);
INSERT INTO `hy_menu` VALUES (3, 'message.router.systemMenu', 2, 'menu', '/system/menu', 'systemMenu', 'system/menu/index', '', 0, '', 0, 1, 0, 0, 'iconfont icon-caidan', 0, 1, 0, 0, NULL);
INSERT INTO `hy_menu` VALUES (4, 'message.router.systemUser', 2, 'menu', '/system/user', 'systemUser', 'system/user/index', '', 0, '', 0, 1, 0, 0, 'iconfont icon-icon-', 0, 1, 0, 0, NULL);
INSERT INTO `hy_menu` VALUES (5, 'message.router.limits', 0, 'menu', '/limits', 'limits', 'layout/routerView/parent', '/limits/frontEnd', 0, '', 0, 1, 0, 0, 'iconfont icon-quanxian', 0, 1, 0, 1679282915, 1679282915);
INSERT INTO `hy_menu` VALUES (6, 'message.router.limitsBackEnd', 5, 'menu', '/limits/backEnd', 'limitsBackEnd', 'layout/routerView/parent', '', 0, '', 0, 1, 0, 0, '', 0, 1, 0, 0, NULL);
INSERT INTO `hy_menu` VALUES (7, 'message.router.menu', 0, 'menu', '/menu', 'menu', 'layout/routerView/parent', '/menu/menu1', 0, '', 0, 1, 0, 0, 'iconfont icon-caidan', 0, 1, 0, 1679282911, 1679282911);
INSERT INTO `hy_menu` VALUES (8, 'message.router.menu1', 7, 'menu', '/menu/menu1', 'menu1', 'layout/routerView/parent', '/menu/menu1/menu11', 0, '', 0, 1, 0, 0, 'iconfont icon-caidan', 0, 1, 0, 0, NULL);
INSERT INTO `hy_menu` VALUES (9, 'message.router.menu2', 7, 'menu', '/menu/menu2', 'menu2', 'menu/menu2/index', '', 0, '', 0, 1, 0, 0, 'iconfont icon-caidan', 0, 1, 0, 0, NULL);
INSERT INTO `hy_menu` VALUES (10, 'message.router.funIndex', 0, 'menu', '/fun', 'funIndex', 'layout/routerView/parent', '/fun/tagsView', 0, '', 0, 1, 0, 0, 'iconfont icon-crew_feature', 0, 1, 0, 1679282906, 1679282906);
INSERT INTO `hy_menu` VALUES (11, 'message.router.funTagsView', 10, 'menu', '/fun/tagsView', 'funTagsView', 'fun/tagsView/index', '', 0, '', 0, 1, 0, 0, 'ele-Pointer', 0, 1, 0, 0, NULL);
INSERT INTO `hy_menu` VALUES (12, 'message.router.chartIndex', 0, 'menu', '/chart', 'chartIndex', 'chart/index', '', 0, '', 0, 1, 0, 0, 'iconfont icon-ico_shuju', 0, 1, 0, 1679282888, 1679282888);
INSERT INTO `hy_menu` VALUES (13, 'message.router.personal', 0, 'menu', '/personal', 'personal', 'personal/index', '', 0, '', 1, 1, 0, 0, 'iconfont icon-gerenzhongxin', 0, 1, 0, 1679282896, NULL);
INSERT INTO `hy_menu` VALUES (14, 'message.router.tools', 0, 'menu', '/tools', 'tools', 'tools/index', '', 0, '', 0, 1, 0, 0, 'iconfont icon-gongju', 0, 1, 0, 1679282883, 1679282883);
INSERT INTO `hy_menu` VALUES (15, 'message.router.layoutLinkView', 0, 'menu', '/link', 'layoutLinkView', 'layout/routerView/link', '', 1, 'https://element-plus.gitee.io/#/zh-CN/component/installation', 0, 0, 0, 0, 'iconfont icon-caozuo-wailian', 0, 1, 0, 1679281771, 1679281771);
INSERT INTO `hy_menu` VALUES (16, 'message.router.layoutIfameView', 0, 'menu', '/iframes', 'layoutIfameView', 'layout/routerView/iframe', '', 1, 'https://gitee.com/lyt-top/vue-next-admin', 0, 1, 0, 1, 'iconfont icon-neiqianshujuchucun', 0, 1, 0, 1679281737, 1679281737);
INSERT INTO `hy_menu` VALUES (28, '权限列表', 2, 'menu', '/role', 'role', 'system/role/index', '', 0, '', 0, 0, 0, 0, 'ele-Collection', 0, 1, 1678958480, 1678958510, NULL);
INSERT INTO `hy_menu` VALUES (29, 'message.router.goods', 0, 'menu', '/goods', 'goods', 'goods/list/index', '/goods/list', 0, '', 0, 0, 0, 0, 'iconfont icon-zidingyibuju', 0, 1, 1679276863, 1679277109, NULL);
INSERT INTO `hy_menu` VALUES (30, '商品列表', 29, 'menu', '/goodsList', 'goodsList', 'goods/list/index', '', 0, '', 0, 0, 0, 0, 'iconfont icon-chazhaobiaodanliebiao', 0, 1, 1679277287, 1679277362, NULL);
INSERT INTO `hy_menu` VALUES (31, '分类列表', 29, 'menu', '/goodsCategory', 'goodsCategory', 'goods/category/index', '', 0, '', 0, 0, 0, 0, 'iconfont icon-juxingkaobei', 0, 1, 1679284233, 1679284233, NULL);
INSERT INTO `hy_menu` VALUES (32, '添加商品', 30, 'menu', '/goodsAdd', 'goodsAdd', 'goods/list/add', '', 0, '', 1, 0, 0, 0, 'ele-DocumentAdd', 0, 1, 1679552473, 1679552473, NULL);
INSERT INTO `hy_menu` VALUES (33, '规格列表', 29, 'menu', '/specs', 'specs', 'goods/specs/index', '', 0, '', 0, 0, 0, 0, 'iconfont icon-zhongduancanshuchaxun', 0, 1, 1679645894, 1679646199, NULL);
INSERT INTO `hy_menu` VALUES (34, '装修', 0, 'menu', '/layout/home', 'layout', 'layout/home/index', '/layout', 0, '', 0, 0, 0, 0, 'iconfont icon-zhongduancanshuchaxun', 0, 1, 1680511419, 1680512594, NULL);
INSERT INTO `hy_menu` VALUES (35, '页面装修', 34, 'menu', '/layout', 'layout', 'layout/home/index', '', 0, '', 0, 0, 0, 0, 'iconfont icon-zujian', 0, 1, 1680512402, 1680512607, NULL);
INSERT INTO `hy_menu` VALUES (36, 'websocket', 0, 'menu', '/websocket', 'websocket', 'websocket/index', '', 0, '', 0, 0, 0, 0, 'iconfont icon-juxingkaobei', 0, 1, 1681181185, 1681181447, NULL);
INSERT INTO `hy_menu` VALUES (37, '测试服务器', 0, 'menu', '/test', 'test', '/test', '', 0, '', 0, 0, 0, 0, 'iconfont icon-bolangneng', 0, 1, 1682327054, 1683789280, 1683789280);

-- ----------------------------
-- Table structure for hy_role
-- ----------------------------
DROP TABLE IF EXISTS `hy_role`;
CREATE TABLE `hy_role`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `roleName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `roleSign` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '角色标识',
  `sort` int NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `menuProps` json NULL,
  `create_time` int NOT NULL DEFAULT 0,
  `update_time` int NOT NULL DEFAULT 0,
  `delete_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_role
-- ----------------------------
INSERT INTO `hy_role` VALUES (1, '决类要律酸价', 'est minim exercitation incididunt consectetur', 0, 1, '到这习论义导观京系革打场角。阶界节矿的过入各须出示圆位金。现张史音共业快话农光天情心问个毛。低她温术色效命置期将真构复水标长名满。律周局教那大题法些认由白们何。相亲该五下维于标般四最机。', '[111, 112]', 1679108425, 1679108425, NULL);
INSERT INTO `hy_role` VALUES (2, '123123', '23333', 0, 0, '', '[1, 2, 3, 4, 28, 5, 6]', 1679275974, 1679275974, NULL);
INSERT INTO `hy_role` VALUES (3, '1111111', '2222', 0, 1, '', '[2, 3, 4, 28, 36]', 1682318321, 1682318321, NULL);

-- ----------------------------
-- Table structure for hy_specs
-- ----------------------------
DROP TABLE IF EXISTS `hy_specs`;
CREATE TABLE `hy_specs`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `sort` int NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_time` int NOT NULL DEFAULT 0,
  `update_time` int NOT NULL DEFAULT 0,
  `delete_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '商品规格表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_specs
-- ----------------------------
INSERT INTO `hy_specs` VALUES (1, '123', 0, 1, 1679647491, 1679648639, 1679648639);
INSERT INTO `hy_specs` VALUES (2, '2222', 0, 1, 1679648361, 1679648361, NULL);
INSERT INTO `hy_specs` VALUES (3, '3333', 0, 1, 1679648364, 1679648367, 1679648367);
INSERT INTO `hy_specs` VALUES (4, '33', 0, 1, 1679713933, 1679713933, NULL);
INSERT INTO `hy_specs` VALUES (5, '44', 0, 1, 1679713940, 1679713940, NULL);
INSERT INTO `hy_specs` VALUES (6, '55', 0, 1, 1679713943, 1679713943, NULL);
INSERT INTO `hy_specs` VALUES (7, '66', 0, 1, 1679713945, 1679713945, NULL);
INSERT INTO `hy_specs` VALUES (8, '77', 0, 1, 1679713959, 1679713959, NULL);
INSERT INTO `hy_specs` VALUES (9, '88', 0, 1, 1679713960, 1679713960, NULL);
INSERT INTO `hy_specs` VALUES (10, '99', 0, 1, 1679713962, 1680510252, 1680510252);
INSERT INTO `hy_specs` VALUES (11, '12', 0, 1, 1679713968, 1680510246, 1680510246);
INSERT INTO `hy_specs` VALUES (12, '13', 0, 1, 1679713970, 1680510257, 1680510257);
INSERT INTO `hy_specs` VALUES (13, 'zehshi ', 0, 1, 1679713975, 1680510241, 1680510241);
INSERT INTO `hy_specs` VALUES (14, '15', 0, 1, 1679713978, 1680510250, 1680510250);
INSERT INTO `hy_specs` VALUES (15, '16', 0, 1, 1679713981, 1680510244, 1680510244);
INSERT INTO `hy_specs` VALUES (16, '17', 0, 1, 1679713984, 1680510255, 1680510255);
INSERT INTO `hy_specs` VALUES (17, '18', 0, 1, 1679713988, 1679713988, NULL);
INSERT INTO `hy_specs` VALUES (18, '19', 0, 1, 1679713991, 1679713991, NULL);
INSERT INTO `hy_specs` VALUES (19, '21', 0, 1, 1679714022, 1679714022, NULL);
INSERT INTO `hy_specs` VALUES (20, '尺码', 0, 1, 1680158540, 1680158540, NULL);
INSERT INTO `hy_specs` VALUES (21, '规格', 0, 1, 1680158544, 1680158544, NULL);

-- ----------------------------
-- Table structure for hy_specs_value
-- ----------------------------
DROP TABLE IF EXISTS `hy_specs_value`;
CREATE TABLE `hy_specs_value`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `specs_id` int NOT NULL DEFAULT 0,
  `title` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int NOT NULL DEFAULT 0,
  `create_time` int NOT NULL DEFAULT 0,
  `update_time` int NOT NULL DEFAULT 0,
  `delete_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '商品规格值' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_specs_value
-- ----------------------------
INSERT INTO `hy_specs_value` VALUES (1, 19, '1', 1, 0, 1679714643, 1679714643, NULL);
INSERT INTO `hy_specs_value` VALUES (2, 19, '2', 1, 0, 1679715066, 1679715066, NULL);
INSERT INTO `hy_specs_value` VALUES (3, 19, '3', 1, 0, 1679715069, 1679715069, NULL);
INSERT INTO `hy_specs_value` VALUES (4, 19, '4', 1, 0, 1679715071, 1679715071, NULL);
INSERT INTO `hy_specs_value` VALUES (5, 19, '5', 1, 0, 1679715124, 1679715124, NULL);
INSERT INTO `hy_specs_value` VALUES (6, 19, '6', 1, 0, 1679715125, 1679715125, NULL);
INSERT INTO `hy_specs_value` VALUES (7, 19, '7', 1, 0, 1679715127, 1679715127, NULL);
INSERT INTO `hy_specs_value` VALUES (8, 19, '8', 1, 0, 1679715129, 1679715129, NULL);
INSERT INTO `hy_specs_value` VALUES (9, 19, '9', 1, 0, 1679715136, 1679715136, NULL);
INSERT INTO `hy_specs_value` VALUES (10, 19, '10', 1, 0, 1679715138, 1679715138, NULL);
INSERT INTO `hy_specs_value` VALUES (11, 18, '123123', 1, 0, 1679715205, 1679715205, NULL);
INSERT INTO `hy_specs_value` VALUES (12, 17, '333', 1, 0, 1679715210, 1679715210, NULL);
INSERT INTO `hy_specs_value` VALUES (13, 16, '444', 1, 0, 1679715212, 1679715212, NULL);
INSERT INTO `hy_specs_value` VALUES (14, 15, '55', 1, 0, 1679715216, 1679715216, NULL);
INSERT INTO `hy_specs_value` VALUES (15, 14, '1', 1, 0, 1679882118, 1679882118, NULL);
INSERT INTO `hy_specs_value` VALUES (16, 14, '2', 1, 0, 1679882120, 1679882120, NULL);
INSERT INTO `hy_specs_value` VALUES (17, 14, '3', 1, 0, 1679882121, 1679882121, NULL);
INSERT INTO `hy_specs_value` VALUES (18, 14, '4', 1, 0, 1679882122, 1679882122, NULL);
INSERT INTO `hy_specs_value` VALUES (19, 14, '5', 1, 0, 1679882123, 1679882123, NULL);
INSERT INTO `hy_specs_value` VALUES (20, 20, 'S', 1, 0, 1680158547, 1680158547, NULL);
INSERT INTO `hy_specs_value` VALUES (21, 20, 'S', 1, 0, 1680158547, 1680158547, NULL);
INSERT INTO `hy_specs_value` VALUES (22, 20, 'L', 1, 0, 1680158551, 1680158551, NULL);
INSERT INTO `hy_specs_value` VALUES (23, 20, 'M', 1, 0, 1680158554, 1680158554, NULL);
INSERT INTO `hy_specs_value` VALUES (24, 21, '大', 1, 0, 1680158570, 1680158570, NULL);
INSERT INTO `hy_specs_value` VALUES (25, 21, '小', 1, 0, 1680158572, 1680158572, NULL);
INSERT INTO `hy_specs_value` VALUES (26, 21, '最大', 1, 0, 1680158575, 1680158575, NULL);
INSERT INTO `hy_specs_value` VALUES (27, 21, '很大', 1, 0, 1680158577, 1680158577, NULL);

-- ----------------------------
-- Table structure for hy_uploader
-- ----------------------------
DROP TABLE IF EXISTS `hy_uploader`;
CREATE TABLE `hy_uploader`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '保存的地址',
  `cate_id` int NOT NULL DEFAULT 0,
  `md5` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `size` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '文件大小',
  `fileName` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '文件原名',
  `type` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `ext` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '文件后缀',
  `upload_ip` bigint NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态 1正常 0关闭 ',
  `create_time` int NOT NULL DEFAULT 0,
  `update_time` int NOT NULL DEFAULT 0,
  `delete_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '上传记录' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_uploader
-- ----------------------------
INSERT INTO `hy_uploader` VALUES (2, '/public/image/2023-03-22/b057021f7b5c616e8770948d87ad324d.jpeg', 0, 'b057021f7b5c616e8770948d87ad324d', '', '2ffe0e09ef2e4dc8b234ae5bed9c0d0b61ff05249fe80-Unu8Vg_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470422, 1679470422);
INSERT INTO `hy_uploader` VALUES (3, '/public/image/2023-03-22/b5719ad31268b5fe0373c30d9b112889.jpeg', 0, 'b5719ad31268b5fe0373c30d9b112889', '', 'ddeb8684565b44ce317167fc6f7d36ca0d7101fc10c53-JQOLDt_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470422, 1679470422);
INSERT INTO `hy_uploader` VALUES (4, '/public/image/2023-03-22/a2ef3be5483f6bf85ebf1e98464ecef6.jpeg', 0, 'a2ef3be5483f6bf85ebf1e98464ecef6', '', '0493d65c41c19fffd8bc341c72768bbce4ee8e4bacade-J1EtsC_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470356, 1679470356);
INSERT INTO `hy_uploader` VALUES (5, '/public/image/2023-03-22/28970d8af96598a16af2bd7635ae857f.jpeg', 0, '28970d8af96598a16af2bd7635ae857f', '', 'fe8fe234199a5c727ce02924ae3a4adba772fa78aaa1f-76b6df_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470281, 1679470281);
INSERT INTO `hy_uploader` VALUES (6, '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 0, '775a83ebe950baf4c353f63855f8e808', '', '1024.png', 'image', 'png', 3232235529, 1, 0, 1679470281, 1679470281);
INSERT INTO `hy_uploader` VALUES (7, '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 0, 'd7c22a4d1baca0ae99bc4d55f1abd534', '', '微信图片_20221101140133.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470281, 1679470281);
INSERT INTO `hy_uploader` VALUES (8, '/public/image/2023-03-22/af08df99616e3e4f1038b161ffcdaf70.jpeg', 3, 'af08df99616e3e4f1038b161ffcdaf70', '', 'ChMkLGN1liWIUfnuAACT6RmJ2J0AAJvMQJvgaUAAJQB562.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470356, 1679470356);
INSERT INTO `hy_uploader` VALUES (9, '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 0, 'd7c22a4d1baca0ae99bc4d55f1abd534', '', '微信图片_20221101140133.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470356, 1679470356);
INSERT INTO `hy_uploader` VALUES (10, '/public/image/2023-03-22/28970d8af96598a16af2bd7635ae857f.jpeg', 0, '28970d8af96598a16af2bd7635ae857f', '', 'fe8fe234199a5c727ce02924ae3a4adba772fa78aaa1f-76b6df_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470356, 1679470356);
INSERT INTO `hy_uploader` VALUES (11, '/public/image/2023-03-22/a2ef3be5483f6bf85ebf1e98464ecef6.jpeg', 0, 'a2ef3be5483f6bf85ebf1e98464ecef6', '', '0493d65c41c19fffd8bc341c72768bbce4ee8e4bacade-J1EtsC_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470422, 1679470422);
INSERT INTO `hy_uploader` VALUES (12, '/public/image/2023-03-22/28970d8af96598a16af2bd7635ae857f.jpeg', 0, '28970d8af96598a16af2bd7635ae857f', '', 'fe8fe234199a5c727ce02924ae3a4adba772fa78aaa1f-76b6df_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470422, 1679470422);
INSERT INTO `hy_uploader` VALUES (13, '/public/image/2023-03-22/b057021f7b5c616e8770948d87ad324d.jpeg', 0, 'b057021f7b5c616e8770948d87ad324d', '', '2ffe0e09ef2e4dc8b234ae5bed9c0d0b61ff05249fe80-Unu8Vg_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470470, 1679470470);
INSERT INTO `hy_uploader` VALUES (14, '/public/image/2023-03-22/b5719ad31268b5fe0373c30d9b112889.jpeg', 0, 'b5719ad31268b5fe0373c30d9b112889', '', 'ddeb8684565b44ce317167fc6f7d36ca0d7101fc10c53-JQOLDt_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470470, 1679470470);
INSERT INTO `hy_uploader` VALUES (15, '/public/image/2023-03-22/a2ef3be5483f6bf85ebf1e98464ecef6.jpeg', 0, 'a2ef3be5483f6bf85ebf1e98464ecef6', '', '0493d65c41c19fffd8bc341c72768bbce4ee8e4bacade-J1EtsC_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470470, 1679470470);
INSERT INTO `hy_uploader` VALUES (16, '/public/image/2023-03-22/28970d8af96598a16af2bd7635ae857f.jpeg', 0, '28970d8af96598a16af2bd7635ae857f', '', 'fe8fe234199a5c727ce02924ae3a4adba772fa78aaa1f-76b6df_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 1679470470, 1679470470);
INSERT INTO `hy_uploader` VALUES (17, '/public/image/2023-03-22/b057021f7b5c616e8770948d87ad324d.jpeg', 0, 'b057021f7b5c616e8770948d87ad324d', '', '2ffe0e09ef2e4dc8b234ae5bed9c0d0b61ff05249fe80-Unu8Vg_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (18, '/public/image/2023-03-22/a2ef3be5483f6bf85ebf1e98464ecef6.jpeg', 0, 'a2ef3be5483f6bf85ebf1e98464ecef6', '', '0493d65c41c19fffd8bc341c72768bbce4ee8e4bacade-J1EtsC_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (19, '/public/image/2023-03-22/b5719ad31268b5fe0373c30d9b112889.jpeg', 0, 'b5719ad31268b5fe0373c30d9b112889', '', 'ddeb8684565b44ce317167fc6f7d36ca0d7101fc10c53-JQOLDt_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (20, '/public/image/2023-03-22/28970d8af96598a16af2bd7635ae857f.jpeg', 0, '28970d8af96598a16af2bd7635ae857f', '', 'fe8fe234199a5c727ce02924ae3a4adba772fa78aaa1f-76b6df_fw658.jpg', 'image', 'jpeg', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (21, '/public/image/2023-03-22/d7c22a4d1baca0ae99bc4d55f1abd534.jpeg', 0, 'd7c22a4d1baca0ae99bc4d55f1abd534', '', '微信图片_20221101140133.jpg', 'image', 'jpeg', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (22, '/public/image/2023-03-22/775a83ebe950baf4c353f63855f8e808.png', 0, '775a83ebe950baf4c353f63855f8e808', '', '1024.png', 'image', 'png', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (23, '/public/image/2023-03-24/af08df99616e3e4f1038b161ffcdaf70.jpeg', 0, 'af08df99616e3e4f1038b161ffcdaf70', '', 'ChMkLGN1liWIUfnuAACT6RmJ2J0AAJvMQJvgaUAAJQB562.jpg', 'image', 'jpeg', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (24, '/public/image/2023-03-24/f45e58d0a0c8dad652a12ad3c7963c0d.jpeg', 0, 'f45e58d0a0c8dad652a12ad3c7963c0d', '', 'ChMkK2N1li6IKrkVAAEAb8Nx1agAAJvMQMkV5cAAQCH804.jpg', 'image', 'jpeg', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (25, '/public/image/2023-03-24/1e55ea5a72fdf654a011517737e07d0c.jpeg', 0, '1e55ea5a72fdf654a011517737e07d0c', '', 'ChMkK2N1liKIU7NsAADJoY1mwwcAAJvMQJRAXcAAMm5431.jpg', 'image', 'jpeg', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (26, '/public/image/2023-03-24/cadae5ccd8bfe93c4f80446a1bac899a.jpeg', 0, 'cadae5ccd8bfe93c4f80446a1bac899a', '', 'ChMkLGN1liiIOiwvAAED3OG0Qq0AAJvMQKvM3wAAQP0820.jpg', 'image', 'jpeg', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (30, '/public/image/2023-03-24/ae752e825c6b49875e13d9f5ea15b67c.jpeg', 0, 'ae752e825c6b49875e13d9f5ea15b67c', '', 'wallhaven-m981jm.jpg', 'image', 'jpeg', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (31, '/public/image/2023-03-24/6d90233c56d7041cf092ac7e3e89413e.png', 0, '6d90233c56d7041cf092ac7e3e89413e', '', '屏幕截图_20221026_112856.png', 'image', 'png', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (32, '/public/image/2023-03-24/be1208ae536b6e8a368acd12099314a4.png', 0, 'be1208ae536b6e8a368acd12099314a4', '', '屏幕截图_20221101_091325.png', 'image', 'png', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (33, '/public/video/2023-03-24/eb928dee38060bf4d42f0cef8b07e1b4.mp4', 0, 'eb928dee38060bf4d42f0cef8b07e1b4', '', 'd88300128a98aa2f1af78c75c77199d6.mp4', 'video', 'mp4', 3232235529, 1, 0, 0, NULL);
INSERT INTO `hy_uploader` VALUES (34, '/public/video/2023-03-24/eb42843f03cb52297f85e16379467720.mp4', 0, 'eb42843f03cb52297f85e16379467720', '', 'WeChat_20221213175823.mp4', 'video', 'mp4', 3232235529, 1, 0, 0, NULL);

-- ----------------------------
-- Table structure for hy_uploader_cate
-- ----------------------------
DROP TABLE IF EXISTS `hy_uploader_cate`;
CREATE TABLE `hy_uploader_cate`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `sort` int NOT NULL DEFAULT 0,
  `create_time` int NOT NULL DEFAULT 0,
  `update_time` int NOT NULL DEFAULT 0,
  `delete_time` int NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '图片分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_uploader_cate
-- ----------------------------
INSERT INTO `hy_uploader_cate` VALUES (1, 'test', 0, 0, 0, NULL, 1);
INSERT INTO `hy_uploader_cate` VALUES (2, '111', 0, 0, 0, NULL, 1);
INSERT INTO `hy_uploader_cate` VALUES (3, '222', 0, 1679369160, 1679369160, NULL, 1);

-- ----------------------------
-- Table structure for hy_user
-- ----------------------------
DROP TABLE IF EXISTS `hy_user`;
CREATE TABLE `hy_user`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `userName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '密码',
  `phone` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT 0 COMMENT '性别 0默认 2女 1男 3保密',
  `email` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `autograph` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '签名',
  `code` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '随机字符串',
  `token` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT 'token',
  `pwd_strength` tinyint(1) NOT NULL DEFAULT 0 COMMENT '密码强度：0弱 1一般 2强 极强',
  `last_login_ip` bigint(20) UNSIGNED ZEROFILL NOT NULL DEFAULT 00000000000000000000 COMMENT '最后登录ip',
  `last_login_time` int NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_time` int NOT NULL DEFAULT 0,
  `update_time` int NOT NULL DEFAULT 0,
  `delete_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_IdUserName`(`id` ASC, `userName` ASC) USING BTREE,
  INDEX `idx_IdPhone`(`id` ASC, `phone` ASC) USING BTREE,
  INDEX `idx_IdEmail`(`id` ASC, `email` ASC) USING BTREE,
  INDEX `idx_userName`(`userName` ASC) USING BTREE,
  INDEX `idx_phone`(`phone` ASC) USING BTREE,
  INDEX `idx_email`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hy_user
-- ----------------------------
INSERT INTO `hy_user` VALUES (1, 'admin', '6e7edcdd68ddd57fbc78dc46d1617315', '15212345678', 1, 'admin@admin.com', '', '今天的努力是为了实现小时候吹过的牛逼', '0ca175b9c0f726a831d895e269332461', '', 0, 00000000003232235529, 1684134213, 1, 1678957452, 1684139276, NULL);
INSERT INTO `hy_user` VALUES (2, 'test1', '6e7edcdd68ddd57fbc78dc46d1617315', '', 0, '', '', '', '0ca175b9c0f726a831d895e269332461', '', 0, 00000000003232235529, 1682319023, 1, 1678957452, 1682319023, NULL);
INSERT INTO `hy_user` VALUES (7, 'text1', 'aad8f1d954f8b18aaa58b9c99a73cb93', '13320251148', 0, '243194993@qq.com', '', '', 'bd2449dcbfff057acbd29e14a805ca31', '', 0, 00000000003232235529, 1684135302, 1, 1682317058, 1684135302, NULL);

SET FOREIGN_KEY_CHECKS = 1;
