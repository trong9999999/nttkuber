
kubectl create ns web-ns

kubectl apply -f mysql-db.yaml

kubectl apply -f phpmyadmin.yaml

kubectl apply -f web.yaml

#Apply xong 3 file thi co the kiem tra cac cau lenh bang cach


kubectl get pods -n web-ns

#Bay h chua the search duoc app tren web vi chua expose service ra ngoai

#Va h se expose bang cau lenh port-forward

kubectl port-forward svc/web-service 8080:80 -n web-ns #service web

kubectl port-forward svc/phpmyadmin-svc 8081:8081	-n web-ns #Service phpmyadmin
