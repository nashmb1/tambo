set :application, "Framing33"
set:domain, "vps116008.ovh.net"
set :user, "root"
set :password, "08TFUYk6"
set :deploy_to,   "/var/www/framing33"
set :app_path,    "app"
set :web_path,    "web"
 
set :scm,         :git
set :repository,  "file:///C:/wamp/www/Framing33"
set :deploy_via, :copy
set :model_manager, "doctrine"

ssh_options[:forward_agent] = true
ssh_options[:port]          = "22"
ssh_options[:config]        = false
 
role :web,   domain                         # Your HTTP server, Apache/etc
role :app,   domain, :primary => true       # This may be the same as your `Web` server
 
set :use_sudo, true
set :use_composer, true
set :keep_releases,  3


 
set :shared_files, [app_path+"/config/parameters.yml"] # Les fichiers à conserver entre chaque déploiement
set :shared_children, [app_path + "/logs", "vendor"] # Idem, mais pour les dossiers

set :writable_dirs, ["app/cache", "app/logs", "app/sessions"]


set :update_vendors, true # Il est conseillé de laisser a false et de ne pas faire de ‘composer update’ directement sur la prod

set :dump_assetic_assets, true # dumper les assets
logger.level = Logger::MAX_LEVEL
 
#Update database Doctrine
before "symfony:cache:warmup", "symfony:doctrine:schema:update"