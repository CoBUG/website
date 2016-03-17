TEST_REMOTE=	root@cobug.org:/var/www/test.cobug/
REMOTE=	root@cobug.org:/var/www/cobug/
LOCAL=	~/Development/cobug_php/

test:
	rsync -auvz --delete --exclude=.git* $(LOCAL) $(TEST_REMOTE)

live:
	rsync -auvz --exclude=.git* $(LOCAL) $(REMOTE)
