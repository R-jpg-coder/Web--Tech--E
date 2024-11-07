public class PalindromeChecker {
    public static void main(String[] args) {
        String input = "racecar"; // Example input
        System.out.println("Is '" + input + "' a palindrome? " + isPalindrome(input));
    }

    public static boolean isPalindrome(String str) {
        int left = 0;
        int right = str.length() - 1;
        while (left < right) {
            if (str.charAt(left) != str.charAt(right)) {
                return false;
            }
            left++;
            right--;
        }
        return true;
    }
}