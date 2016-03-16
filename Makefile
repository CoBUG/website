REMOTE=	root@cobug.org:/var/www/test.cobug/
LOCAL=	~/Development/cobug_php/

test:
	rsync -auvz $(LOCAL) $(REMOTE)
