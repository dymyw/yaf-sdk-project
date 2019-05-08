## 初始化 yaf-sdk 项目

### 目录结构

```
- app
    - business（模块公共方法）
    - controllers（默认控制器）
        - Error.php（异常和错误处理）
        - Index.php（默认控制器）
    - library（本地类库）
        - Base（基础）
            - BaseAction.php（基础控制器方法）
            - BaseException.php（基础异常处理）
        - Common（公共）
            - Action
            - Exception
                - CategoryException.php（分类异常处理）
            - ConstMap.php（公共常量配置）
    - models（数据模型）
        - Common
            - CategoryModel.php（公共分类数据模型）
        - BaseModel.php（基础数据模型）
    - modules（功能模块）
        - Common
            - actions
                - Category
                    - Info.php
            - controllers
                - Category.php
            - requests
                - Category
                    - Info.php
    - Bootstrap.php
- conf
    - application.ini（配置文件）
- public
    - index.php（入口文件）
```

### 编辑 `conf/application.ini`

- log.path
- 数据库配置
- redis 配置

数据表 `t_category`

```sql
CREATE TABLE `t_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` varchar(16) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级分类id',
  `weight` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '权重',
  `depth` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '深度，从1递增',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类型 1=地址',
  `row_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 -1=无效 1=显示 2=隐藏',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 08:00:00' COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `idxc_category_type_pid` (`type`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COMMENT='分类表';
```

### 约定

注意

- app/modules/Xxx/controllers/Xxx.php，其中 Xxx.php 只能首字母大写

### TODO

### 变更记录
