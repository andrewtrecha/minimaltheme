import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';
// loads the Icon plugin
UIkit.use(Icons);
// components can be called from the imported UIkit reference
UIkit.notification({
    message: 'my-message!',
    status: 'primary',
    pos: 'top-center',
    timeout: 5000
});
