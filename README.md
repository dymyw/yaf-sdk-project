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
- 接口请求地址配置
- 数据库配置
- redis 配置

### 约定

注意

- app/modules/Xxx/controllers/Xxx.php，其中 Xxx.php 只能首字母大写

### TODO

- curl 请求 ✅

### 变更记录
