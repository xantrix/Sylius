#app/console server:run 127.0.0.1:8080 --env=test --no-debug > webserver.log 2>&1 &
#--no-debug
nohup app/console server:run 127.0.0.1:8080 --env=test_cached --router=app/config/router_test_cached.php > webserver.log 2>&1 &