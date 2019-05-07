### Add row from push service
 * 11.02.19
 * @genia
--------------
```
ALTER TABLE `params` 
ADD `push_service` varchar(255), 
ADD `id_worker` varchar(255), 
ADD `id_manifest` varchar(255),
ADD `id_head_js` varchar(255);

```
### Add row from push service (sp-push-worker-fb.js)
 * 19.03.19
 * @genia
--------------
```
ALTER TABLE `params` 
ADD `id_worker_fb` varchar(255);
```
### Add subscribe identificator into Clients 
 * 21.03.19
 * @genia
--------------
```
ALTER TABLE `clients` 
ADD `subscribe` tinyint(1);
```
