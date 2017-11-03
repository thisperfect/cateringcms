<?php
namespace Vendor\Password;
class Password
{
    const PASSWORD_COST = 11; // 这里配置bcrypt算法的代价，根据需要来随时升级
    const PASSWORD_ALGO = PASSWORD_BCRYPT; // 默认使用（现在也只能用）bcrypt
    /**
    * 验证密码
    *
    * @param string $plainPassword 用户密码的明文
    * @param string $hashPassword 用户密码的密文
    * @param bool  $autoRehash    是否自动重新计算下密码的hash值（如果有必要的话）
    * @return bool
    */
    public function verifyPassword($plainPassword,$hashPassword, $autoRehash = true)
    {
        if (password_verify($plainPassword,$hashPassword)) {
            if ($autoRehash && password_needs_rehash($hashPassword, self::PASSWORD_ALGO, ['cost' => self::PASSWORD_COST])) {
                $this->setPassword($plainPassword);
            }
            return true;
        }
        return false;
    }
    /**
    * 设置密码
    *
    * @param string $newPlainPassword
    */
    public function setPassword($newPlainPassword)
    {
        $hashPassword = password_hash($newPlainPassword, self::PASSWORD_ALGO, ['cost' => self::PASSWORD_COST]);
        return $hashPassword;
    }
}