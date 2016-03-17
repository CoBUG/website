REMOTE=	root@cobug.org:/var/www/test.cobug/
LOCAL=	~/Development/cobug_php/

test:
	rsync -auvz --delete --exclude=.git* $(LOCAL) $(REMOTE)
