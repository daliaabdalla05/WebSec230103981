use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

public function run()
{
    $user = User::find(1); // ID of the user you're assigning
    $user->assignRole('admin');
    $user->givePermissionTo('edit books');
}
