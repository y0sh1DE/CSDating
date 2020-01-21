if [ -z "$STY" ]; then exec screen -dm -S mcserver /bin/bash "$0"; fi
exec /home/minecraft/mcserver/start.sh
