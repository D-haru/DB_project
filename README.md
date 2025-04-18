맞춤형 공공혜택 안내 시스템: 복지 사각지대 해소를 위한 데이터베이스 솔루션
프로젝트 소개
본 프로젝트는 국민들이 받을 수 있는 다양한 공공혜택 정보에 대한 접근성을 높이고 복지 사각지대를 해소하기 위해 개발된 맞춤형 공공혜택 안내 시스템입니다. 많은 시민들이 자신이 받을 수 있는 혜택을 인지하지 못해 지원을 놓치는 문제를 해결하고자, Oracle DB를 기반으로 사용자 개인정보와 혜택 정보를 효율적으로 연계하는 데이터베이스 아키텍처를 설계했습니다.

주요 기능 및 특징
비로그인 사용자를 위한 일반 혜택 검색 기능: 개인정보 입력 없이도 기본적인 공공혜택 정보 조회 가능
개인 맞춤형 혜택 추천 시스템: 사용자의 인적사항(연령, 소득분위, 지역, 가구유형 등)을 기반으로 최적화된 혜택 정보 제공
마이페이지 기능: 로그인 사용자를 위한 개인화된 서비스 제공
관리자 기능: 회원-혜택 매핑 관리 및 데이터 분석 기능
데이터 보안 및 개인정보 보호: 회원 탈퇴 시 관련 정보 완전 삭제 기능 구현
기술 스택
백엔드: Oracle Database (관계형 데이터베이스 설계, 트리거, 프로시저)
서버 로직: PHP (데이터베이스 연동 및 비즈니스 로직 처리)
프론트엔드: HTML/CSS (사용자 인터페이스 구현)
데이터베이스 설계
ER 다이어그램을 통해 구현된 주요 엔티티 관계:

고객(Customer) 테이블: 기본 회원정보 관리
인적사항(Personal Data) 테이블: 맞춤형 혜택 제공을 위한 상세 정보
혜택(Benefit) 테이블: 공공혜택 정보 저장
고객_혜택 테이블: 회원과 혜택 간의 매핑 관리
부서(Department) 테이블: 혜택 관리 부서 정보
구현 특징
트리거를 활용한 자동화된 회원-혜택 매핑 시스템
개인정보 보호를 위한 데이터 처리 로직
사용자 친화적 인터페이스로 복잡한 공공혜택 정보를 직관적으로 제공
확장성을 고려한 데이터베이스 설계로 새로운 혜택 유형 추가 용이
이 프로젝트는 데이터베이스 설계 원칙과 웹 개발 기술을 활용하여 실질적인 사회 문제 해결에 기여하는 솔루션을 제시했습니다. 특히 복잡한 공공혜택 정보를 개인화하여 제공함으로써 정보 비대칭 문제를 해소하고 복지서비스의 효율성을 높이는 데 중점을 두었습니다.
