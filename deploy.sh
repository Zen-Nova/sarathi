
cd public_html
git stash 
export GIT_SSH_COMMAND="ssh -i ~/.ssh/id_ed25519_fireflies -o IdentitiesOnly=yes"
git pull
chmod +x deploy/build.sh 
    ./deploy/build.sh


username :
password :
