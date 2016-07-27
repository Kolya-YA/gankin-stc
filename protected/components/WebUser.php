<?

class WebUser extends CWebUser
{
	public function getRole()
	{
		return $this->getState("role");
	}
	
	public function checkAccess($operation, $params=array())
	{
		if (empty($this->id)) {
			// Not identified => no rights
			return false;
		}
		$role = $this->getState("role");
		if ($role === 'admin') {
			return true; // admin role has access to everything
		}
		// allow access if the operation request is the current user's role
		return ($operation === $role);
	}
}